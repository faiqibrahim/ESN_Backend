<?php
App::uses('AppController', 'Controller');
/**
 * Groupcontents Controller
 *
 * @property Groupcontent $Groupcontent
 * @property PaginatorComponent $Paginator
 */
class GroupcontentsController extends AppController {

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
		$this->Groupcontent->recursive = 0;
		$this->set('groupcontents', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Groupcontent->exists($id)) {
			throw new NotFoundException(__('Invalid groupcontent'));
		}
		$options = array('conditions' => array('Groupcontent.' . $this->Groupcontent->primaryKey => $id));
		$this->set('groupcontent', $this->Groupcontent->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Groupcontent->create();
			if ($this->Groupcontent->save($this->request->data)) {
				$this->Session->setFlash(__('The groupcontent has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groupcontent could not be saved. Please, try again.'));
			}
		}
		$groups = $this->Groupcontent->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Groupcontent->exists($id)) {
			throw new NotFoundException(__('Invalid groupcontent'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Groupcontent->save($this->request->data)) {
				$this->Session->setFlash(__('The groupcontent has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groupcontent could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Groupcontent.' . $this->Groupcontent->primaryKey => $id));
			$this->request->data = $this->Groupcontent->find('first', $options);
		}
		$groups = $this->Groupcontent->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Groupcontent->id = $id;
		if (!$this->Groupcontent->exists()) {
			throw new NotFoundException(__('Invalid groupcontent'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Groupcontent->delete()) {
			$this->Session->setFlash(__('The groupcontent has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groupcontent could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
