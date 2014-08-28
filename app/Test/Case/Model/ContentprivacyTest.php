<?php
App::uses('Contentprivacy', 'Model');

/**
 * Contentprivacy Test Case
 *
 */
class ContentprivacyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.contentprivacy',
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
		'app.profile',
		'app.request',
		'app.requesttype',
		'app.role',
		'app.requesttypes_role',
		'app.users_role',
		'app.privacy'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Contentprivacy = ClassRegistry::init('Contentprivacy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contentprivacy);

		parent::tearDown();
	}

}
