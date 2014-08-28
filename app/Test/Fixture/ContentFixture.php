<?php
/**
 * ContentFixture
 *
 */
class ContentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'content' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'contenttype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'post_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'task_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'solution_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'contentprivacy_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'groupcontent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_contents_content_types1_idx' => array('column' => 'contenttype_id', 'unique' => 0),
			'fk_contents_posts1_idx' => array('column' => 'post_id', 'unique' => 0),
			'fk_contents_tasks1_idx' => array('column' => 'task_id', 'unique' => 0),
			'fk_contents_solutions1_idx' => array('column' => 'solution_id', 'unique' => 0),
			'fk_contents_contentprivacy1_idx' => array('column' => 'contentprivacy_id', 'unique' => 0),
			'fk_contents_classcontent1_idx' => array('column' => 'groupcontent_id', 'unique' => 0)
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
			'content' => 'Lorem ipsum dolor sit amet',
			'contenttype_id' => 1,
			'post_id' => 1,
			'task_id' => 1,
			'solution_id' => 1,
			'contentprivacy_id' => 1,
			'groupcontent_id' => 1
		),
	);

}
