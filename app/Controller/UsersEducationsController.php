<?php
App::uses('AppController', 'Controller');
/**
 * UsersEducations Controller
 *
 * @property UsersEducation $UsersEducation
 * @property PaginatorComponent $Paginator
 */
class UsersEducationsController extends AppController {

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
		$this->UsersEducation->recursive = 0;
		$this->set('usersEducations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersEducation->exists($id)) {
			throw new NotFoundException(__('Invalid users education'));
		}
		$options = array('conditions' => array('UsersEducation.' . $this->UsersEducation->primaryKey => $id));
		$this->set('usersEducation', $this->UsersEducation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersEducation->create();
			if ($this->UsersEducation->save($this->request->data)) {
				$this->Session->setFlash(__('The users education has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users education could not be saved. Please, try again.'));
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
		if (!$this->UsersEducation->exists($id)) {
			throw new NotFoundException(__('Invalid users education'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersEducation->save($this->request->data)) {
				$this->Session->setFlash(__('The users education has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The users education could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersEducation.' . $this->UsersEducation->primaryKey => $id));
			$this->request->data = $this->UsersEducation->find('first', $options);
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
		$this->UsersEducation->id = $id;
		if (!$this->UsersEducation->exists()) {
			throw new NotFoundException(__('Invalid users education'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersEducation->delete()) {
			$this->Session->setFlash(__('The users education has been deleted.'));
		} else {
			$this->Session->setFlash(__('The users education could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
