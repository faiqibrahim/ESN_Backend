<?php
App::uses('AppModel', 'Model');
/**
 * Grouprole Model
 *
 * @property GroupUser $GroupUser
 */
class Grouprole extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'GroupUser' => array(
			'className' => 'GroupUser',
			'foreignKey' => 'grouprole_id',
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
