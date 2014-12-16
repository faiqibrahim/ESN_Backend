<?php
App::uses('AppController', 'Controller');

/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController
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
        $this->Auth->allow('add', 'getById');
    }

    public function getById($id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            if (!$this->Group->exists($id)) {
                $result['message'] = 'Invalid Group';
                $result['success'] = false;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
                $group = $this->Group->find('first', $options);
                $result['group'] = $group;
                $result['success'] = true;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            }
        } else {
            $result['message'] = 'Invalid Request';
            $result['success'] = false;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }

    }

    public function index()
    {
        $this->Group->recursive = 0;
        $users = $this->Group->find('all');
        $this->set(array(
            'groups' => $users,
            '_serialize' => array('groups')
        ));
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
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
        $this->set('group', $this->Group->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Group->create();
            $this->request->data['Group']['user_id'] = $this->Auth->user('id');

            if ($this->Group->save($this->request->data)) {
                $result['message'] = 'Group Added.';
                $result['success'] = true;
                $result['group_id'] = $this->Group->id;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['message'] = 'Group could not be added.';
                $result['success'] = false;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            }
        } else {
            $result['message'] = 'Invalid Request';
            $result['success'] = false;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));

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
        if (!$this->Group->exists($id)) {
            throw new NotFoundException(__('Invalid group'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('The group has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
            $this->request->data = $this->Group->find('first', $options);
        }
        $users = $this->Group->User->find('list');
        $groupprivacies = $this->Group->Groupprivacy->find('list');
        $this->set(compact('users', 'groupprivacies'));
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
        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Invalid group'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Group->delete()) {
            $this->Session->setFlash(__('The group has been deleted.'));
        } else {
            $this->Session->setFlash(__('The group could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
