<?php
App::uses('ClassifiedsAppController', 'Classifieds.Controller');
/**
 * Classifieds Controller
 *
 * @property Classified $Classified
 */
class ClassifiedsController extends ClassifiedsAppController {

/**
 * Helpers
 *
 * @var array
 */
	//public $helpers = array('Media');
	
	public $uses = 'Classifieds.Classified';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Classified->recursive = 0;
		if(CakePlugin::loaded('Categories')) {
			$this->set('categories', $this->Classified->Category->find('list', array('conditions' => array('model' => 'Classified'))));
			$this->paginate['contain'][] = 'Category';
			if(isset($this->request->query['categories'])) {
				$categoriesParam = explode(';', rawurldecode($this->request->query['categories']));
				$this->set('selected_categories', json_encode($categoriesParam));
				$joins = array(
			           array('table'=>'categorized', 
			                 'alias' => 'Categorized',
			                 'type'=>'left',
			                 'conditions'=> array(
			                 	'Categorized.foreign_key = Classified.id'
			           )),
			           array('table'=>'categories', 
			                 'alias' => 'Category',
			                 'type'=>'left',
			                 'conditions'=> array(
			                 	'Category.id = Categorized.category_id'
					   ))
			         );
				$this->paginate['joins'] = $joins;
				$this->paginate['order']['Classified.is_featured'] = 'DESC';
				$this->paginate['conditions'] = array('Category.name' => $categoriesParam);
				$this->paginate['fields'] = array(
					'DISTINCT Classified.id',
					'Classified.title',
					'Classified.description',
					'Classified.condition',
					'Classified.payment_terms',
					'Classified.shipping_terms',
					'Classified.price',
					'Classified.city',
					'Classified.state',
					'Classified.zip',
					'Classified.weight',
					'Classified.is_featured',
					'Classified.created',
					'Classified.expire_date'
					);
			}
		}
		if(isset($this->request->query['q'])) {
			$categoriesParam = explode(';', rawurldecode($this->request->query['categories']));
			$this->paginate['conditions']['Category.name'] = $categoriesParam;
			$this->paginate['conditions']['OR'] = array(
				'Classified.title LIKE' => '%' . $this->request->query['q'] . '%',
				'Classified.description' => '%' . $this->request->query['q'] . '%'
			);
		}
		$this->set('classifieds', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Classified->id = $id;
		if (!$this->Classified->exists()) {
			throw new NotFoundException(__('Invalid classified'));
		}
		$this->Classified->contain(array('Category','Creator' => array('Gallery' => 'GalleryThumbnail')));
		$this->set('classified', $this->Classified->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Classified->create();
			if ($this->Classified->save($this->request->data)) {
				$this->Session->setFlash(__('The Classified has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Classified could not be saved. Please, try again.'));
			}
		}

		if (CakePlugin::loaded('Categories')) {
			$this->set('categories', $this->Classified->Category->find('all', array(
				'conditions' => array('model' => 'Classified')
			)));
		}
	}
	
/**
 * post method
 * 
 * uses galleries in the view instead of media
 * 
 */
	public function post() {
		return $this->add();
	}
 
/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Classified->id = $id;
		if (!$this->Classified->exists()) {
			throw new NotFoundException(__('Invalid classified'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Classified->save($this->request->data)) {
				$this->Session->setFlash(__('The classified has been saved'));
				$this->redirect(array('action' => 'index'));			 
			} else {
				$this->Session->setFlash(__('The classified could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Classified->read(null, $id);
			if(CakePlugin::loaded('Categories')) {
				$this->set('categories', $this->Classified->Category->find('list', array('conditions' => array('model' => 'Classified'))));
			}
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Classified->id = $id;
		if (!$this->Classified->exists()) {
			throw new NotFoundException(__('Invalid classified'));
		}
		if ($this->Classified->delete()) {
			$this->Session->setFlash(__('Classified deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Classified was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function categories() {
		if (CakePlugin::loaded('Categories')) {
			$this->request->data = $this->Classified->Category->find('all', array(
					'conditions' => array(
							'model' => 'Classified',
					),
					'order' => array('name' => 'ASC')
			));
		} else {
			throw new NotFoundException(__('Invalid URL'));
			//$this->redirect($this->referer('/'));
		}
	}

/**
 * contact method
 *
 * @param string $id
 * @return void
 */
	public function contact($id = null) {
		$this->Classified->id = $id;
		if (!$this->Classified->exists()) {
			throw new NotFoundException(__('Invalid classified'));
		}
		if ($this->request->is('post') || $this->request->is('push')) {
			$classified = $this->Classified->find('first', array('conditions' => array('Classified.id' => $id), 'contain' => array('Creator')));
			$email = $classified['Creator']['email'];
			$subject = __('%s received response on %s', $classified['Classified']['title'], __SYSTEM_SITE_NAME);
			$message = __('<p>Sender : %s</p><p>%s</p>', $this->request->data['Classified']['your_email'], strip_tags($this->request->data['Classified']['your_message']));
			
			if (!empty($email)) {
				try {
					$this->__sendMail($email, $subject, $message); 
					$this->Session->setFlash('Message sent');
					unset($this->request->data);
				} catch (Exception $e) {
					if (Configure::read('debug') > 0) {
						$this->Session->setFlash($e->getMessage());
					} else {
						$this->Session->setFlash('Error, please try again later.');
					}
				}
			} else {
				$this->Session->setFlash('Creator is not accepting contacts via email.');
			}
		}
		$this->Classified->contain(array('Category','Creator' => array('Gallery' => 'GalleryThumbnail')));
		$this->set('classified', $this->Classified->read(null, $id));
	}
}
