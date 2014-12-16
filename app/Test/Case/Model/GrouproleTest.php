<?php
App::uses('Grouprole', 'Model');

/**
 * Grouprole Test Case
 *
 */
class GrouproleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.grouprole',
		'app.group_user',
		'app.group',
		'app.user',
		'app.answer',
		'app.question',
		'app.boardmessage',
		'app.contact',
		'app.contactrole',
		'app.message',
		'app.post',
		'app.privacy',
		'app.content',
		'app.contenttype',
		'app.task',
		'app.solution',
		'app.contentprivacy',
		'app.groupcontent',
		'app.request',
		'app.requesttype',
		'app.role',
		'app.requesttypes_role',
		'app.users_role',
		'app.education',
		'app.users_education',
		'app.interest',
		'app.users_interest',
		'app.groupprivacy',
		'app.announcement'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Grouprole = ClassRegistry::init('Grouprole');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Grouprole);

		parent::tearDown();
	}

}
