<?php
App::uses('Education', 'Model');

/**
 * Education Test Case
 *
 */
class EducationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.education',
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
		'app.request',
		'app.requesttype',
		'app.role',
		'app.requesttypes_role',
		'app.users_role',
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
		$this->Education = ClassRegistry::init('Education');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Education);

		parent::tearDown();
	}

}
