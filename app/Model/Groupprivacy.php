<?php
App::uses('AppModel', 'Model');
/**
 * Groupprivacy Model
 *
 * @property Group $Group
 */
class Groupprivacy extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'groupprivacy_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
