<?php
App::uses('AppController', 'Controller');
/**
 * RequesttypesRoles Controller
 *
 * @property RequesttypesRole $RequesttypesRole
 * @property PaginatorComponent $Paginator
 */
class RequesttypesRolesController extends AppController {

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
		$this->RequesttypesRole->recursive = 0;
		$this->set('requesttypesRoles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RequesttypesRole->exists($id)) {
			throw new NotFoundException(__('Invalid requesttypes role'));
		}
		$options = array('conditions' => array('RequesttypesRole.' . $this->RequesttypesRole->primaryKey => $id));
		$this->set('requesttypesRole', $this->RequesttypesRole->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RequesttypesRole->create();
			if ($this->RequesttypesRole->save($this->request->data)) {
				$this->Session->setFlash(__('The requesttypes role has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requesttypes role could not be saved. Please, try again.'));
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
		if (!$this->RequesttypesRole->exists($id)) {
			throw new NotFoundException(__('Invalid requesttypes role'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RequesttypesRole->save($this->request->data)) {
				$this->Session->setFlash(__('The requesttypes role has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requesttypes role could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RequesttypesRole.' . $this->RequesttypesRole->primaryKey => $id));
			$this->request->data = $this->RequesttypesRole->find('first', $options);
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
		$this->RequesttypesRole->id = $id;
		if (!$this->RequesttypesRole->exists()) {
			throw new NotFoundException(__('Invalid requesttypes role'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RequesttypesRole->delete()) {
			$this->Session->setFlash(__('The requesttypes role has been deleted.'));
		} else {
			$this->Session->setFlash(__('The requesttypes role could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
