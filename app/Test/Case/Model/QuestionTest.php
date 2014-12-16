<?php
App::uses('Question', 'Model');

/**
 * Question Test Case
 *
 */
class QuestionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.question',
		'app.user',
		'app.answer',
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
		$this->Question = ClassRegistry::init('Question');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Question);

		parent::tearDown();
	}

}
