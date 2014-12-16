<?php
App::uses('Privacy', 'Model');

/**
 * Privacy Test Case
 *
 */
class PrivacyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.privacy',
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
		'app.content',
		'app.contenttype',
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
		$this->Privacy = ClassRegistry::init('Privacy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Privacy);

		parent::tearDown();
	}

}
