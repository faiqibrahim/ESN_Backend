<?php
App::uses('AppController', 'Controller');
/**
 * Grouproles Controller
 *
 * @property Grouprole $Grouprole
 * @property PaginatorComponent $Paginator
 */
class GrouprolesController extends AppController {

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
		$this->Grouprole->recursive = 0;
		$this->set('grouproles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Grouprole->exists($id)) {
			throw new NotFoundException(__('Invalid grouprole'));
		}
		$options = array('conditions' => array('Grouprole.' . $this->Grouprole->primaryKey => $id));
		$this->set('grouprole', $this->Grouprole->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Grouprole->create();
			if ($this->Grouprole->save($this->request->data)) {
				$this->Session->setFlash(__('The grouprole has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grouprole could not be saved. Please, try again.'));
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
		if (!$this->Grouprole->exists($id)) {
			throw new NotFoundException(__('Invalid grouprole'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Grouprole->save($this->request->data)) {
				$this->Session->setFlash(__('The grouprole has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grouprole could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Grouprole.' . $this->Grouprole->primaryKey => $id));
			$this->request->data = $this->Grouprole->find('first', $options);
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
		$this->Grouprole->id = $id;
		if (!$this->Grouprole->exists()) {
			throw new NotFoundException(__('Invalid grouprole'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Grouprole->delete()) {
			$this->Session->setFlash(__('The grouprole has been deleted.'));
		} else {
			$this->Session->setFlash(__('The grouprole could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
