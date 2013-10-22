<?php 
class ClassifiedsSchema extends CakeSchema {

	public $renames = array();

	public function __construct($options = array()) {
		parent::__construct();
	}

	public function before($event = array()) {
		App::uses('UpdateSchema', 'Model'); 
		$this->UpdateSchema = new UpdateSchema;
		$before = $this->UpdateSchema->before($event);
		return $before;
	}

	public function after($event = array()) {
		$this->UpdateSchema->rename($event, $this->renames);
		$this->UpdateSchema->after($event);
	}

	public $classifieds = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'Title of Item', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'Description', 'charset' => 'utf8'),
		'condition' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'Item Condition', 'charset' => 'utf8'),
		'payment_terms' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'Payment Terms', 'charset' => 'utf8'),
		'shipping_terms' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'Shipping Terms', 'charset' => 'utf8'),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'city' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'city', 'charset' => 'utf8'),
		'state' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'state', 'charset' => 'utf8'),
		'zip' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'zip code', 'charset' => 'utf8'),
		'weight' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'comment' => 'Weight of ad, used for levels of premium'),
		'posted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL, 'comment' => 'Posted Date'),
		'expire_date' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'comment' => 'Expiration Date'),
		'creator_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'comment' => 'Creator', 'charset' => 'utf8'),
		'is_featured' => array('type' => 'boolean', 'null' => false, 'default' => 0),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'comment' => 'Created Date'),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL, 'comment' => 'Modified Date'),
		'data' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'Data Column', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
}
