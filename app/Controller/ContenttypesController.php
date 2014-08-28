<?php
App::uses('AppController', 'Controller');
/**
 * Contenttypes Controller
 *
 * @property Contenttype $Contenttype
 * @property PaginatorComponent $Paginator
 */
class ContenttypesController extends AppController {

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
		$this->Contenttype->recursive = 0;
		$this->set('contenttypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contenttype->exists($id)) {
			throw new NotFoundException(__('Invalid contenttype'));
		}
		$options = array('conditions' => array('Contenttype.' . $this->Contenttype->primaryKey => $id));
		$this->set('contenttype', $this->Contenttype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contenttype->create();
			if ($this->Contenttype->save($this->request->data)) {
				$this->Session->setFlash(__('The contenttype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contenttype could not be saved. Please, try again.'));
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
		if (!$this->Contenttype->exists($id)) {
			throw new NotFoundException(__('Invalid contenttype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contenttype->save($this->request->data)) {
				$this->Session->setFlash(__('The contenttype has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contenttype could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contenttype.' . $this->Contenttype->primaryKey => $id));
			$this->request->data = $this->Contenttype->find('first', $options);
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
		$this->Contenttype->id = $id;
		if (!$this->Contenttype->exists()) {
			throw new NotFoundException(__('Invalid contenttype'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Contenttype->delete()) {
			$this->Session->setFlash(__('The contenttype has been deleted.'));
		} else {
			$this->Session->setFlash(__('The contenttype could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
