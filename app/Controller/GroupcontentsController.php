<?php
App::uses('AppController', 'Controller');

/**
 * Groupcontents Controller
 *
 * @property Groupcontent $Groupcontent
 * @property PaginatorComponent $Paginator
 */
class GroupcontentsController extends AppController
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
        $this->Auth->allow('add', 'delete', 'getByGroup');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Groupcontent->recursive = 0;
        $this->set('groupcontents', $this->Paginator->paginate());
    }

    public function getByGroup($id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {

            if (!$this->Groupcontent->Group->exists($id)) {
                $result['message'] = 'Invalid Group';
                $result['success'] = false;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $authorized = false;
                $owner_id = $this->Groupcontent->Group->findById($id)['Group']['user_id'];
                if ($owner_id != null && $owner_id == $this->Auth->user('id')) {
                    $authorized = true;
                } else {
                    $options = array('conditions' => array('GroupUser.user_id' => $this->Auth->user('id'), 'GroupUser.group_id' => $id));
                    $check = $this->Groupcontent->Group->GroupUser->find('first', $options);
                    if ($check != null) {
                        $authorized = true;
                    }
                }
                if ($authorized) {
                    $content = $this->Groupcontent->findAllByGroupId($id);

                    $result['group_contents'] = $content;
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
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


    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public
    function view($id = null)
    {
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
    public
    function add()
    {
        if ($this->request->is('post')) {
            $this->Groupcontent->create();
            if ($this->Groupcontent->save($this->request->data)) {
                $result['message'] = 'Content Successfully Added.';
                $result['content'] = $this->Groupcontent->findById($this->Groupcontent->id);
                $result['success'] = true;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));

            } else {
                $result['message'] = 'Content failed to upload please try again.';
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
    public
    function edit($id = null)
    {
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
    public function delete($id = null)
    {
        if ($this->request->is('post') || $this->request->is('delete')) {
            $this->Groupcontent->id = $id;
            if (!$this->Groupcontent->exists()) {
                $result['success'] = false;
                $result['message'] = 'Invalid content';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $authorized = false;
                $owner_id = $this->Groupcontent->findById($id)['Group']['user_id'];
                if ($owner_id != null && $owner_id == $this->Auth->user('id')) {
                    $authorized = true;
                }
                if ($authorized && $this->Groupcontent->delete()) {
                    $result['success'] = true;
                    $result['message'] = 'The content has been deleted';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['success'] = false;
                    $result['message'] = 'The content could not be deleted';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }
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
}
