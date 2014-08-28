<?php
App::uses('Group', 'Model');

/**
 * Group Test Case
 *
 */
class GroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.profile',
		'app.task',
		'app.solution',
		'app.contentprivacy',
		'app.groupcontent',
		'app.request',
		'app.requesttype',
		'app.role',
		'app.requesttypes_role',
		'app.users_role',
		'app.groupprivacy',
		'app.announcement',
		'app.group_user',
		'app.grouprole'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Group = ClassRegistry::init('Group');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Group);

		parent::tearDown();
	}

}
