<?php
App::uses('AppController', 'Controller');
/**
 * UsersRoles Controller
 *
 * @property UsersRole $UsersRole
 * @property PaginatorComponent $Paginator
 */
class UsersRolesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UsersRole->recursive = 0;
		$this->set('usersRoles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersRole->exists($id)) {
			throw new NotFoundException(__('Invalid users role'));
		}
		$options = array('conditions' => array('UsersRole.' . $this->UsersRole->primaryKey => $id));
		$this->set('usersRole', $this->UsersRole->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersRole->create();
			if ($this->UsersRole->save($this->request->data)) {
				$this->Session->setFlash(__('The users role has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users role could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UsersRole->exists($id)) {
			throw new NotFoundException(__('Invalid users role'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersRole->save($this->request->data)) {
				$this->Session->setFlash(__('The users role has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users role could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersRole.' . $this->UsersRole->primaryKey => $id));
			$this->request->data = $this->UsersRole->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UsersRole->id = $id;
		if (!$this->UsersRole->exists()) {
			throw new NotFoundException(__('Invalid users role'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersRole->delete()) {
			$this->Session->setFlash(__('The users role has been deleted.'));
		} else {
			$this->Session->setFlash(__('The users role could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
