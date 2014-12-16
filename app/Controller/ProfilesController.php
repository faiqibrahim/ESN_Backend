<?php
App::uses('AppController', 'Controller');

/**
 * Profiles Controller
 *
 * @property Profile $Profile
 * @property PaginatorComponent $Paginator
 */
class ProfilesController extends AppController
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
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index()
    {
        $this->Profile->recursive = 0;
        $this->set('profiles', $this->Paginator->paginate());
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
        if (!$this->Profile->exists($id)) {
            throw new NotFoundException(__('Invalid profile'));
        }
        $options = array('conditions' => array('Profile.' . $this->Profile->primaryKey => $id));
        $this->set('profile', $this->Profile->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Profile->create();
            if ($this->Profile->save($this->request->data)) {
                $this->Session->setFlash(__('The profile has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
            }
        }
        $users = $this->Profile->User->find('list');
        $this->set(compact('users'));
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
        if (!$this->Profile->exists($id)) {
            throw new NotFoundException(__('Invalid profile'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Profile->save($this->request->data)) {
                $this->Session->setFlash(__('The profile has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Profile.' . $this->Profile->primaryKey => $id));
            $this->request->data = $this->Profile->find('first', $options);
        }
        $users = $this->Profile->User->find('list');
        $this->set(compact('users'));
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
        $this->Profile->id = $id;
        if (!$this->Profile->exists()) {
            throw new NotFoundException(__('Invalid profile'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Profile->delete()) {
            $this->Session->setFlash(__('The profile has been deleted.'));
        } else {
            $this->Session->setFlash(__('The profile could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
