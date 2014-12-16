<?php
App::uses('Groupprivacy', 'Model');

/**
 * Groupprivacy Test Case
 *
 */
class GroupprivacyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.groupprivacy',
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
		$this->Groupprivacy = ClassRegistry::init('Groupprivacy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Groupprivacy);

		parent::tearDown();
	}

}
