<?php
App::uses('Content', 'Model');

/**
 * Content Test Case
 *
 */
class ContentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.content',
		'app.contenttype',
		'app.post',
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
		'app.task',
		'app.solution',
		'app.contact',
		'app.contactrole',
		'app.message',
		'app.request',
		'app.requesttype',
		'app.role',
		'app.requesttypes_role',
		'app.users_role',
		'app.education',
		'app.users_education',
		'app.interest',
		'app.users_interest',
		'app.privacy',
		'app.contentprivacy'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Content = ClassRegistry::init('Content');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Content);

		parent::tearDown();
	}

}
