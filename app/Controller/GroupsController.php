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
        $this->Auth->allow('add', 'edit', 'getById', 'getUserInfo', 'getRequests', 'acceptRequest', 'rejectRequest', 'deleteInterest', 'deleteUser');
    }

    public function getUsers($id = null)
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
                $users = $this->Group->GroupUser->findAllByGroupId($id);
                $result['users'] = $users;
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

    public function getRequests($id = null)
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
                $owner_id = $this->Group->findById($id)['Group']['user_id'];
                if ($owner_id == $this->Auth->user('id')) {
                    $requests = $this->Group->JoinRequest->findAllByGroupId($id);
                    $result['requests'] = $requests;
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['requests'] = [];
                    $result['message'] = "You are not authorized to access requests";
                    $result['success'] = false;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }

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

    public function acceptRequest()
    {
        if ($this->request->is('post')) {

            $owner_id = $this->Group->findById($this->request->data['JoinRequest']['group_id'])['Group']['user_id'];
            if ($owner_id == $this->Auth->user('id')) {

                $user_id = $this->request->data['JoinRequest']['user_id'];
                $group_id = $this->request->data['JoinRequest']['group_id'];
                if ($this->Group->JoinRequest->deleteAll(array('JoinRequest.user_id' => $user_id, 'JoinRequest.group_id' => $group_id))) {
                    $this->Group->GroupUser->create();
                    $data = array('user_id' => $user_id, 'group_id' => $group_id, 'grouprole_id' => 2);
                    if ($this->Group->GroupUser->save($data)) {
                        $result['message'] = "Request Accepted";
                        $result['success'] = true;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    } else {
                        $result['requests'] = "Some Error occured";
                        $result['success'] = false;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    }
                } else {
                    $result['requests'] = "Some Error occured";
                    $result['success'] = false;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }


            } else {
                $result['requests'] = [];
                $result['message'] = "You are not authorized to accept requests";
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

    public function rejectRequest()
    {
        if ($this->request->is('post')) {

            $owner_id = $this->Group->findById($this->request->data['JoinRequest']['group_id'])['Group']['user_id'];
            if ($owner_id == $this->Auth->user('id')) {

                $user_id = $this->request->data['JoinRequest']['user_id'];
                $group_id = $this->request->data['JoinRequest']['group_id'];
                if ($this->Group->JoinRequest->deleteAll(array('JoinRequest.user_id' => $user_id, 'JoinRequest.group_id' => $group_id))) {

                    $result['message'] = "Request Rejected";
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));

                } else {
                    $result['requests'] = "Some Error occured";
                    $result['success'] = false;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }


            } else {
                $result['requests'] = [];
                $result['message'] = "You are not authorized to reject requests";
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

    public function getUserInfo($id)
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
                $result['group'] = $this->Group->findById($id)['Group'];

                $group = $this->Group->findByIdAndUserId($id, $this->Auth->user('id'));
                if (isset($group['User'])) {
                    $result['group_owner'] = true;
                    $result['User'] = $group['User'];
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $options = array('conditions' => array('GroupUser.group_id' => $id, 'GroupUser.user_id' => $this->Auth->user('id')));
                    $group = $this->Group->GroupUser->find('first', $options);
                    if (isset($group['User'])) {
                        $result['group_owner'] = false;
                        $result['group_joined'] = true;
                        $result['User'] = $group['User'];
                        $result['success'] = true;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    } else {
                        $options = array('conditions' => array('JoinRequest.group_id' => $id, 'JoinRequest.user_id' => $this->Auth->user('id')));
                        $group = $this->Group->JoinRequest->find('first', $options);
                        if (isset($group['User'])) {
                            $result['group_owner'] = false;
                            $result['group_joined'] = false;
                            $result['group_requested'] = true;
                            $result['User'] = $group['User'];
                            $result['success'] = true;
                            $this->set(array(
                                'result' => $result,
                                '_serialize' => array('result')
                            ));
                        } else {
                            $result['group_owner'] = false;
                            $result['group_joined'] = false;
                            $result['group_requested'] = false;
                            $result['success'] = true;
                            $this->set(array(
                                'result' => $result,
                                '_serialize' => array('result')
                            ));
                        }
                    }
                }

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
            $result['message'] = 'Invalid Group';
            $result['success'] = false;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
            return;
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Group']['user_id'] = $this->Auth->user('id');
            $owner_id = $this->Group->findById($id)['Group']['user_id'];
            if ($owner_id == $this->Auth->user('id')) {
                if ($this->Group->save($this->request->data)) {
                    $result['message'] = 'Group updated';
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['message'] = 'Could not update Group';
                    $result['success'] = false;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }
            } else {
                $result['message'] = 'Not Authorized';
                $result['success'] = false;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            }

        } else {
            $result['message'] = 'Invalid request';
            $result['success'] = false;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    public function deleteInterest($interest_id = null, $group_id = null)
    {
        if (!$this->Group->exists($group_id)) {
            $result['message'] = 'Invalid Group';
            $result['success'] = false;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
            return;
        }
        if ($this->request->is('delete')) {

            $owner_id = $this->Group->findById($group_id)['Group']['user_id'];
            if ($owner_id == $this->Auth->user('id')) {
                if ($this->Group->GroupsInterest->deleteAll(array('GroupsInterest.group_id' => $group_id, 'GroupsInterest.interest_id' => $interest_id))) {
                    $result['success'] = true;
                    $result['message'] = 'Interest Deleted';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));

                } else {
                    $result['success'] = false;
                    $result['message'] = 'Interest could not be deleted';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));

                }
            } else {
                $result['success'] = false;
                $result['message'] = 'Not Authorized';
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

    public function deleteUser($user_id = null, $group_id = null)
    {
        if (!$this->Group->exists($group_id)) {
            $result['message'] = 'Invalid Group';
            $result['success'] = false;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
            return;
        }
        if ($this->request->is('delete')) {

            $owner_id = $this->Group->findById($group_id)['Group']['user_id'];
            if ($owner_id == $this->Auth->user('id')) {
                if ($this->Group->GroupUser->deleteAll(array('GroupUser.group_id' => $group_id, 'GroupUser.user_id' => $user_id))) {
                    $result['success'] = true;
                    $result['message'] = 'User Removed';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));

                } else {
                    $result['success'] = false;
                    $result['message'] = 'User could not be removed';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));

                }
            } else {
                $result['success'] = false;
                $result['message'] = 'Not Authorized';
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
