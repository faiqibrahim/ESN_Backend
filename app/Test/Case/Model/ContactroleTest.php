<?php
App::uses('Contactrole', 'Model');

/**
 * Contactrole Test Case
 *
 */
class ContactroleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.contactrole',
		'app.contact',
		'app.user',
		'app.answer',
		'app.question',
		'app.group',
		'app.groupprivacy',
		'app.announcement',
		'app.boardmessage',
		'app.group_user',
		'app.grouprole',
		'app.groupcontent',
		'app.content',
		'app.contenttype',
		'app.post',
		'app.privacy',
		'app.task',
		'app.solution',
		'app.contentprivacy',
		'app.message',
		'app.request',
		'app.requesttype',
		'app.role',
		'app.requesttypes_role',
		'app.users_role',
		'app.education',
		'app.users_education',
		'app.interest',
		'app.users_interest'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Contactrole = ClassRegistry::init('Contactrole');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contactrole);

		parent::tearDown();
	}

}
