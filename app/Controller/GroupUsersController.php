<?php
App::uses('AppController', 'Controller');

/**
 * GroupUsers Controller
 *
 * @property GroupUser $GroupUser
 * @property PaginatorComponent $Paginator
 */
class GroupUsersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add','delete');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->GroupUser->recursive = 0;
        $this->set('groupUsers', $this->Paginator->paginate());
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
        if (!$this->GroupUser->exists($id)) {
            throw new NotFoundException(__('Invalid group user'));
        }
        $options = array('conditions' => array('GroupUser.' . $this->GroupUser->primaryKey => $id));
        $this->set('groupUser', $this->GroupUser->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->GroupUser->create();
            $this->request->data['grouprole_id'] = 2;
            if ($this->GroupUser->save($this->request->data)) {
                $result['message'] = 'User Added.';
                $result['success'] = true;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['message'] = 'User could not be added.';
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
        if (!$this->GroupUser->exists($id)) {
            throw new NotFoundException(__('Invalid group user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->GroupUser->save($this->request->data)) {
                $this->Session->setFlash(__('The group user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The group user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('GroupUser.' . $this->GroupUser->primaryKey => $id));
            $this->request->data = $this->GroupUser->find('first', $options);
        }
        $groups = $this->GroupUser->Group->find('list');
        $users = $this->GroupUser->User->find('list');
        $grouproles = $this->GroupUser->Grouprole->find('list');
        $this->set(compact('groups', 'users', 'grouproles'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @return void
     */
    public function delete($id)
    {
        if ($this->request->is('delete')) {
            if ($this->GroupUser->deleteAll(array('GroupUser.user_id' => $this->Auth->user('id'), 'GroupUser.group_id' => $id))) {
                $result['success'] = true;
                $result['message'] = 'UnJoined';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));

            } else {
                $result['success'] = false;
                $result['message'] = 'Group could not be Unjoined';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));

            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid request type';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }
}
