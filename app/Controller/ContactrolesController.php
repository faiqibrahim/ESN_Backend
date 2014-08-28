<?php
App::uses('AppController', 'Controller');
/**
 * Contactroles Controller
 *
 * @property Contactrole $Contactrole
 * @property PaginatorComponent $Paginator
 */
class ContactrolesController extends AppController {

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
		$this->Contactrole->recursive = 0;
		$this->set('contactroles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contactrole->exists($id)) {
			throw new NotFoundException(__('Invalid contactrole'));
		}
		$options = array('conditions' => array('Contactrole.' . $this->Contactrole->primaryKey => $id));
		$this->set('contactrole', $this->Contactrole->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contactrole->create();
			if ($this->Contactrole->save($this->request->data)) {
				$this->Session->setFlash(__('The contactrole has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contactrole could not be saved. Please, try again.'));
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
		if (!$this->Contactrole->exists($id)) {
			throw new NotFoundException(__('Invalid contactrole'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contactrole->save($this->request->data)) {
				$this->Session->setFlash(__('The contactrole has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contactrole could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contactrole.' . $this->Contactrole->primaryKey => $id));
			$this->request->data = $this->Contactrole->find('first', $options);
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
		$this->Contactrole->id = $id;
		if (!$this->Contactrole->exists()) {
			throw new NotFoundException(__('Invalid contactrole'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Contactrole->delete()) {
			$this->Session->setFlash(__('The contactrole has been deleted.'));
		} else {
			$this->Session->setFlash(__('The contactrole could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
