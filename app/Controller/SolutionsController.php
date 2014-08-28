<?php
App::uses('AppController', 'Controller');
/**
 * Solutions Controller
 *
 * @property Solution $Solution
 * @property PaginatorComponent $Paginator
 */
class SolutionsController extends AppController {

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
		$this->Solution->recursive = 0;
		$this->set('solutions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Solution->exists($id)) {
			throw new NotFoundException(__('Invalid solution'));
		}
		$options = array('conditions' => array('Solution.' . $this->Solution->primaryKey => $id));
		$this->set('solution', $this->Solution->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Solution->create();
			if ($this->Solution->save($this->request->data)) {
				$this->Session->setFlash(__('The solution has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The solution could not be saved. Please, try again.'));
			}
		}
		$tasks = $this->Solution->Task->find('list');
		$users = $this->Solution->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Solution->exists($id)) {
			throw new NotFoundException(__('Invalid solution'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Solution->save($this->request->data)) {
				$this->Session->setFlash(__('The solution has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The solution could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Solution.' . $this->Solution->primaryKey => $id));
			$this->request->data = $this->Solution->find('first', $options);
		}
		$tasks = $this->Solution->Task->find('list');
		$users = $this->Solution->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Solution->id = $id;
		if (!$this->Solution->exists()) {
			throw new NotFoundException(__('Invalid solution'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Solution->delete()) {
			$this->Session->setFlash(__('The solution has been deleted.'));
		} else {
			$this->Session->setFlash(__('The solution could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
