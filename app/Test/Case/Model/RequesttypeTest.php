<?php
App::uses('Requesttype', 'Model');

/**
 * Requesttype Test Case
 *
 */
class RequesttypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.requesttype',
		'app.request',
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
		'app.contact',
		'app.contactrole',
		'app.message',
		'app.education',
		'app.users_education',
		'app.interest',
		'app.users_interest',
		'app.role',
		'app.requesttypes_role',
		'app.users_role'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Requesttype = ClassRegistry::init('Requesttype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Requesttype);

		parent::tearDown();
	}

}
