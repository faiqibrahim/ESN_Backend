<?php
App::uses('AppController', 'Controller');
/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class PrivaciesController extends AppController {

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
		$this->Privacy->recursive = 0;
		$this->set('privacies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Privacy->exists($id)) {
			throw new NotFoundException(__('Invalid privacy'));
		}
		$options = array('conditions' => array('Privacy.' . $this->Privacy->primaryKey => $id));
		$this->set('privacy', $this->Privacy->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Privacy->create();
			if ($this->Privacy->save($this->request->data)) {
				$this->Session->setFlash(__('The privacy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The privacy could not be saved. Please, try again.'));
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
		if (!$this->Privacy->exists($id)) {
			throw new NotFoundException(__('Invalid privacy'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Privacy->save($this->request->data)) {
				$this->Session->setFlash(__('The privacy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The privacy could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Privacy.' . $this->Privacy->primaryKey => $id));
			$this->request->data = $this->Privacy->find('first', $options);
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
		$this->Privacy->id = $id;
		if (!$this->Privacy->exists()) {
			throw new NotFoundException(__('Invalid privacy'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Privacy->delete()) {
			$this->Session->setFlash(__('The privacy has been deleted.'));
		} else {
			$this->Session->setFlash(__('The privacy could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
