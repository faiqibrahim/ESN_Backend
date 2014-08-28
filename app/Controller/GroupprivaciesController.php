<?php
App::uses('AppController', 'Controller');
/**
 * Groupprivacies Controller
 *
 * @property Groupprivacy $Groupprivacy
 * @property PaginatorComponent $Paginator
 */
class GroupprivaciesController extends AppController {

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
		$this->Groupprivacy->recursive = 0;
		$this->set('groupprivacies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Groupprivacy->exists($id)) {
			throw new NotFoundException(__('Invalid groupprivacy'));
		}
		$options = array('conditions' => array('Groupprivacy.' . $this->Groupprivacy->primaryKey => $id));
		$this->set('groupprivacy', $this->Groupprivacy->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Groupprivacy->create();
			if ($this->Groupprivacy->save($this->request->data)) {
				$this->Session->setFlash(__('The groupprivacy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groupprivacy could not be saved. Please, try again.'));
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
		if (!$this->Groupprivacy->exists($id)) {
			throw new NotFoundException(__('Invalid groupprivacy'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Groupprivacy->save($this->request->data)) {
				$this->Session->setFlash(__('The groupprivacy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groupprivacy could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Groupprivacy.' . $this->Groupprivacy->primaryKey => $id));
			$this->request->data = $this->Groupprivacy->find('first', $options);
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
		$this->Groupprivacy->id = $id;
		if (!$this->Groupprivacy->exists()) {
			throw new NotFoundException(__('Invalid groupprivacy'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Groupprivacy->delete()) {
			$this->Session->setFlash(__('The groupprivacy has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groupprivacy could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
