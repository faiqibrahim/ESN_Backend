<?php
App::uses('AppController', 'Controller');
/**
 * Requesttypes Controller
 *
 * @property Requesttype $Requesttype
 * @property PaginatorComponent $Paginator
 */
class RequesttypesController extends AppController {

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
		$this->Requesttype->recursive = 0;
		$this->set('requesttypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Requesttype->exists($id)) {
			throw new NotFoundException(__('Invalid requesttype'));
		}
		$options = array('conditions' => array('Requesttype.' . $this->Requesttype->primaryKey => $id));
		$this->set('requesttype', $this->Requesttype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Requesttype->create();
			if ($this->Requesttype->save($this->request->data)) {
				$this->Session->setFlash(__('The requesttype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requesttype could not be saved. Please, try again.'));
			}
		}
		$roles = $this->Requesttype->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Requesttype->exists($id)) {
			throw new NotFoundException(__('Invalid requesttype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Requesttype->save($this->request->data)) {
				$this->Session->setFlash(__('The requesttype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requesttype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Requesttype.' . $this->Requesttype->primaryKey => $id));
			$this->request->data = $this->Requesttype->find('first', $options);
		}
		$roles = $this->Requesttype->Role->find('list');
		$this->set(compact('roles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Requesttype->id = $id;
		if (!$this->Requesttype->exists()) {
			throw new NotFoundException(__('Invalid requesttype'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Requesttype->delete()) {
			$this->Session->setFlash(__('The requesttype has been deleted.'));
		} else {
			$this->Session->setFlash(__('The requesttype could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
