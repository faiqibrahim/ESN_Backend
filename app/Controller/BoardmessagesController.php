<?php
App::uses('AppController', 'Controller');
/**
 * Boardmessages Controller
 *
 * @property Boardmessage $Boardmessage
 * @property PaginatorComponent $Paginator
 */
class BoardmessagesController extends AppController {

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
		$this->Boardmessage->recursive = 0;
		$this->set('boardmessages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Boardmessage->exists($id)) {
			throw new NotFoundException(__('Invalid boardmessage'));
		}
		$options = array('conditions' => array('Boardmessage.' . $this->Boardmessage->primaryKey => $id));
		$this->set('boardmessage', $this->Boardmessage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Boardmessage->create();
			if ($this->Boardmessage->save($this->request->data)) {
				$this->Session->setFlash(__('The boardmessage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The boardmessage could not be saved. Please, try again.'));
			}
		}
		$groups = $this->Boardmessage->Group->find('list');
		$users = $this->Boardmessage->User->find('list');
		$this->set(compact('groups', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Boardmessage->exists($id)) {
			throw new NotFoundException(__('Invalid boardmessage'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Boardmessage->save($this->request->data)) {
				$this->Session->setFlash(__('The boardmessage has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The boardmessage could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Boardmessage.' . $this->Boardmessage->primaryKey => $id));
			$this->request->data = $this->Boardmessage->find('first', $options);
		}
		$groups = $this->Boardmessage->Group->find('list');
		$users = $this->Boardmessage->User->find('list');
		$this->set(compact('groups', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Boardmessage->id = $id;
		if (!$this->Boardmessage->exists()) {
			throw new NotFoundException(__('Invalid boardmessage'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Boardmessage->delete()) {
			$this->Session->setFlash(__('The boardmessage has been deleted.'));
		} else {
			$this->Session->setFlash(__('The boardmessage could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
