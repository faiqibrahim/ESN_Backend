<?php
App::uses('Answer', 'Model');

/**
 * Answer Test Case
 *
 */
class AnswerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.answer',
		'app.question',
		'app.user',
		'app.boardmessage',
		'app.group',
		'app.groupprivacy',
		'app.announcement',
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
		$this->Answer = ClassRegistry::init('Answer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Answer);

		parent::tearDown();
	}

}
