<?php
App::uses('AppController', 'Controller');

/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController
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
        $this->Auth->allow('findByUser','findByGroup', 'add', 'delete', 'edit');
    }

    public function index()
    {
        $this->Post->recursive = 0;
        $this->set('posts', $this->Paginator->paginate());
    }

    public function findByUser($id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $posts = $this->Post->findAllByUserId($id);
            $result['success'] = true;
            $result['posts'] = $posts;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid Request';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }

    }

    public function findByGroup($id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $posts = $this->Post->findAllByGroupId($id);
            $result['success'] = true;
            $result['posts'] = $posts;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
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
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid post'));
        }
        $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
        $this->set('post', $this->Post->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Post->create();
            $this->request->data['Post']['user_id']=$this->Auth->user('id');

            if ($this->Post->save($this->request->data)) {
                $new_post = $this->Post->findById($this->Post->id);
                $result['success'] = true;
                $result['post'] = $new_post;
                $result['message'] = 'Post has been saved';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['success'] = false;
                $result['message'] = 'Post could not be saved';
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
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if ($this->request->is('post')) {
            if (!$this->Post->exists($id)) {
                $result['success'] = false;
                $result['message'] = 'Invalid Post';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                if ($this->Post->save($this->request->data)) {
                    $result['success'] = true;
                    $result['message'] = 'Post has been saved';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['success'] = false;
                    $result['message'] = 'Post could not be saved';
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
            $this->Post->id = $id;
            if (!$this->Post->exists()) {
                $result['success'] = false;
                $result['message'] = 'Invalid Post';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                if ($this->Post->delete()) {
                    $result['success'] = true;
                    $result['message'] = 'The post has been deleted';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['success'] = false;
                    $result['message'] = 'The post could not be deleted';
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
