<?php
App::uses('AppController', 'Controller');
/**
 * Contentprivacies Controller
 *
 * @property Contentprivacy $Contentprivacy
 * @property PaginatorComponent $Paginator
 */
class ContentprivaciesController extends AppController {

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
		$this->Contentprivacy->recursive = 0;
		$this->set('contentprivacies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contentprivacy->exists($id)) {
			throw new NotFoundException(__('Invalid contentprivacy'));
		}
		$options = array('conditions' => array('Contentprivacy.' . $this->Contentprivacy->primaryKey => $id));
		$this->set('contentprivacy', $this->Contentprivacy->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contentprivacy->create();
			if ($this->Contentprivacy->save($this->request->data)) {
				$this->Session->setFlash(__('The contentprivacy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contentprivacy could not be saved. Please, try again.'));
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
		if (!$this->Contentprivacy->exists($id)) {
			throw new NotFoundException(__('Invalid contentprivacy'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contentprivacy->save($this->request->data)) {
				$this->Session->setFlash(__('The contentprivacy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contentprivacy could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contentprivacy.' . $this->Contentprivacy->primaryKey => $id));
			$this->request->data = $this->Contentprivacy->find('first', $options);
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
		$this->Contentprivacy->id = $id;
		if (!$this->Contentprivacy->exists()) {
			throw new NotFoundException(__('Invalid contentprivacy'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Contentprivacy->delete()) {
			$this->Session->setFlash(__('The contentprivacy has been deleted.'));
		} else {
			$this->Session->setFlash(__('The contentprivacy could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
