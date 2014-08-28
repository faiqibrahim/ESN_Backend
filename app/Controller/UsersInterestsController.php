<?php
App::uses('AppController', 'Controller');
/**
 * UsersInterests Controller
 *
 * @property UsersInterest $UsersInterest
 * @property PaginatorComponent $Paginator
 */
class UsersInterestsController extends AppController {

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
		$this->UsersInterest->recursive = 0;
		$this->set('usersInterests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersInterest->exists($id)) {
			throw new NotFoundException(__('Invalid users interest'));
		}
		$options = array('conditions' => array('UsersInterest.' . $this->UsersInterest->primaryKey => $id));
		$this->set('usersInterest', $this->UsersInterest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersInterest->create();
			if ($this->UsersInterest->save($this->request->data)) {
				$this->Session->setFlash(__('The users interest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users interest could not be saved. Please, try again.'));
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
		if (!$this->UsersInterest->exists($id)) {
			throw new NotFoundException(__('Invalid users interest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersInterest->save($this->request->data)) {
				$this->Session->setFlash(__('The users interest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users interest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersInterest.' . $this->UsersInterest->primaryKey => $id));
			$this->request->data = $this->UsersInterest->find('first', $options);
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
		$this->UsersInterest->id = $id;
		if (!$this->UsersInterest->exists()) {
			throw new NotFoundException(__('Invalid users interest'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersInterest->delete()) {
			$this->Session->setFlash(__('The users interest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The users interest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
