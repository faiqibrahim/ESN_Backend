<?php
App::uses('AppController', 'Controller');

/**
 * Announcements Controller
 *
 * @property Announcement $Announcement
 * @property PaginatorComponent $Paginator
 */
class AnnouncementsController extends AppController
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
        $this->Auth->allow('add', 'delete', 'getByGroup');
    }

    public function index()
    {
        $this->Announcement->recursive = 0;
        $this->set('announcements', $this->Paginator->paginate());
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
        if (!$this->Announcement->exists($id)) {
            throw new NotFoundException(__('Invalid announcement'));
        }
        $options = array('conditions' => array('Announcement.' . $this->Announcement->primaryKey => $id));
        $this->set('announcement', $this->Announcement->find('first', $options));
    }

    public function getByGroup($id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $authorized = false;
            $user_id = $this->Auth->user('id');

            $owner_id = $this->Announcement->Group->findById($id)['Group']['user_id'];

            if ($user_id == $owner_id) {
                $authorized = true;
            }
            $temp = $this->Announcement->Group->GroupUser->find('first', array('conditions' => array('GroupUser.user_id' => $user_id, 'GroupUser.group_id' => $id)));
            if (sizeof($temp) > 0) {
                $authorized = true;
            }
            if ($authorized) {
                $options = array(
                    'conditions' => array('Announcement.group_id' => $id),
                    'order' => array('Announcement.created' => 'DESC'));
                $posts = $this->Announcement->find('all', $options);
                $result['success'] = true;
                $result['announcements'] = $posts;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['success'] = false;
                $result['message'] = 'You are not authorized to perform this action';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            }

        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid Request';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $user_id = $this->Announcement->Group->findById($this->request->data['Announcement']['group_id'])['User']['id'];
            if ($user_id != null && $user_id == $this->Auth->user('id')) {
                $this->Announcement->create();

                if ($this->Announcement->save($this->request->data)) {
                    $result['message'] = 'Announcement Added.';
                    $result['success'] = true;
                    $result['announcement'] = $this->Announcement->findById($this->Announcement->id);
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['message'] = 'Announcement could not be added.';
                    $result['success'] = false;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }
            } else {
                $result['message'] = 'You are not authorized to perform this action';
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
        if (!$this->Announcement->exists($id)) {
            throw new NotFoundException(__('Invalid announcement'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Announcement->save($this->request->data)) {
                $this->Session->setFlash(__('The announcement has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The announcement could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Announcement.' . $this->Announcement->primaryKey => $id));
            $this->request->data = $this->Announcement->find('first', $options);
        }
        $groups = $this->Announcement->Group->find('list');
        $this->set(compact('groups'));
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
        if ($this->request->is('post') || $this->request->is('delete')) {
            $this->Announcement->id = $id;
            if (!$this->Announcement->exists()) {
                $result['message'] = 'Invalid Announcement';
                $result['success'] = false;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $user_id = $this->Announcement->findById($id)['Group']['user_id'];
                if ($user_id != null && $user_id == $this->Auth->user('id')) {
                    if ($this->Announcement->delete()) {
                        $result['message'] = 'Announcement Deleted';
                        $result['success'] = true;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    } else {
                        $result['message'] = 'The announcement could not be deleted. Please, try again.';
                        $result['success'] = true;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    }
                } else {
                    $result['message'] = 'You are not authorized to perform this action';
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
}
