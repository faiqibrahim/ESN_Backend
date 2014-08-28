<?php
App::uses('AppModel', 'Model');
/**
 * Content Model
 *
 * @property Contenttype $Contenttype
 * @property Post $Post
 * @property Task $Task
 * @property Solution $Solution
 * @property Contentprivacy $Contentprivacy
 * @property Groupcontent $Groupcontent
 */
class Content extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'contenttype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Contenttype' => array(
			'className' => 'Contenttype',
			'foreignKey' => 'contenttype_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'task_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Solution' => array(
			'className' => 'Solution',
			'foreignKey' => 'solution_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Contentprivacy' => array(
			'className' => 'Contentprivacy',
			'foreignKey' => 'contentprivacy_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Groupcontent' => array(
			'className' => 'Groupcontent',
			'foreignKey' => 'groupcontent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
