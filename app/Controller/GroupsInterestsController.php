<?php
App::uses('AppController', 'Controller');

/**
 * GroupsInterests Controller
 *
 * @property GroupsInterest $GroupsInterest
 * @property PaginatorComponent $Paginator
 */
class GroupsInterestsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */

    public $components = array('Paginator', 'RequestHandler');

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->GroupsInterest->recursive = 0;
        $users = $this->GroupsInterest->find('all');
        $this->set(array(
            'users' => $users,
            '_serialize' => array('users')
        ));
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add', '');
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->GroupsInterest->exists($id)) {
            throw new NotFoundException(__('Invalid Groups interest'));
        }
        $options = array('conditions' => array('GroupsInterest.' . $this->GroupsInterest->primaryKey => $id));
        $this->set('GroupsInterest', $this->GroupsInterest->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->GroupsInterest->create();
            if ($this->GroupsInterest->save($this->request->data)) {
                $this->Session->setFlash(__('The Groups interest has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Groups interest could not be saved. Please, try again.'));
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
    public function edit($id = null)
    {
        if (!$this->GroupsInterest->exists($id)) {
            throw new NotFoundException(__('Invalid Groups interest'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->GroupsInterest->save($this->request->data)) {
                $this->Session->setFlash(__('The Groups interest has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Groups interest could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('GroupsInterest.' . $this->GroupsInterest->primaryKey => $id));
            $this->request->data = $this->GroupsInterest->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->GroupsInterest->id = $id;
        if (!$this->GroupsInterest->exists()) {
            throw new NotFoundException(__('Invalid Groups interest'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->GroupsInterest->delete()) {
            $this->Session->setFlash(__('The Groups interest has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Groups interest could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
