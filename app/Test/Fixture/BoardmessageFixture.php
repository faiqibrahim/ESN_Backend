<?php
/**
 * BoardmessageFixture
 *
 */
class BoardmessageFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'boardmessage';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'message' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'generated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_messageboard_class1_idx' => array('column' => 'group_id', 'unique' => 0),
			'fk_messageboard_users1_idx' => array('column' => 'user_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'message' => 'Lorem ipsum dolor sit amet',
			'group_id' => 1,
			'user_id' => 1,
			'generated' => '2014-11-27 05:56:34'
		),
	);

}
