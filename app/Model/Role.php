<?php
App::uses('AppModel', 'Model');
/**
 * Role Model
 *
 * @property Requesttype $Requesttype
 * @property User $User
 */
class Role extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Requesttype' => array(
			'className' => 'Requesttype',
			'joinTable' => 'requesttypes_roles',
			'foreignKey' => 'role_id',
			'associationForeignKey' => 'requesttype_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_roles',
			'foreignKey' => 'role_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
