<?php
App::uses('Contenttype', 'Model');

/**
 * Contenttype Test Case
 *
 */
class ContenttypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.contenttype',
		'app.content',
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
		$this->Contenttype = ClassRegistry::init('Contenttype');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contenttype);

		parent::tearDown();
	}

}
