<?php
App::uses('AppController', 'Controller');
/**
 * Interests Controller
 *
 * @property Interest $Interest
 * @property PaginatorComponent $Paginator
 */
class InterestsController extends AppController {

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
		$this->Interest->recursive = 0;
		$this->set('interests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Interest->exists($id)) {
			throw new NotFoundException(__('Invalid interest'));
		}
		$options = array('conditions' => array('Interest.' . $this->Interest->primaryKey => $id));
		$this->set('interest', $this->Interest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Interest->create();
			if ($this->Interest->save($this->request->data)) {
				$this->Session->setFlash(__('The interest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest could not be saved. Please, try again.'));
			}
		}
		$users = $this->Interest->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Interest->exists($id)) {
			throw new NotFoundException(__('Invalid interest'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Interest->save($this->request->data)) {
				$this->Session->setFlash(__('The interest has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The interest could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Interest.' . $this->Interest->primaryKey => $id));
			$this->request->data = $this->Interest->find('first', $options);
		}
		$users = $this->Interest->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Interest->id = $id;
		if (!$this->Interest->exists()) {
			throw new NotFoundException(__('Invalid interest'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Interest->delete()) {
			$this->Session->setFlash(__('The interest has been deleted.'));
		} else {
			$this->Session->setFlash(__('The interest could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
