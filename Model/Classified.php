<?php
App::uses('ClassifiedsAppModel', 'Classifieds.Model');
/**
 * Classified Model
 *
 * @property Creator $Creator
 */
class Classified extends ClassifiedsAppModel {
		
	public $name = 'Classified';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
        
 /**
  * Acts as
  * 
  * @var array
  */
    public $actsAs = array(
        'Galleries.Mediable' => array('modelAlias' => 'Classified'),
		);
		
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Creator' => array(
			'className' => 'Users.User',
			'foreignKey' => 'creator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * Constructor
 * 
 */
	public function __construct($id = false, $table = null, $ds = null) {
		
		if(CakePlugin::loaded('Media')) {
			$this->actsAs[] = 'Media.MediaAttachable';
		}
		
		if(CakePlugin::loaded('Categories')) {
			$this->actsAs[] = 'Categories.Categorizable';
			$this->hasAndBelongsToMany['Category'] = array(
					'className' => 'Categories.Category',
					'foreignKey' => 'foreign_key',
					'associationForeignKey' => 'category_id',
					'with' => 'Categories.Categorized'
				);
		}
		
		parent::__construct($id = false, $table = null, $ds = null);
	}
}
