<?php
App::uses('Announcement', 'Model');

/**
 * Announcement Test Case
 *
 */
class AnnouncementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.announcement',
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
		'app.groups_interest',
		'app.groupprivacy',
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
		$this->Announcement = ClassRegistry::init('Announcement');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Announcement);

		parent::tearDown();
	}

}
