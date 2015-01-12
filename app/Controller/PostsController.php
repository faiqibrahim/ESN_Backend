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
        $this->Auth->allow('findByUser', 'getForUserProfile', 'findByGroup', 'add', 'delete', 'edit', 'getHomePosts');
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

    private function addArrayToArray($src_array, $values)
    {
        foreach ($values as $value) {
            array_push($src_array, $value);
        }
        return $src_array;
    }

    private function cmp($a, $b)
    {
        $ad = new DateTime($a['Post']['modified']);
        $bd = new DateTime($b['Post']['modified']);

        if ($ad == $bd) {
            return 0;
        }

        return $ad < $bd ? 1 : -1;
    }

    public function getHomePosts()
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $user_id = $this->Auth->user('id');
            $result = array();
            $result['posts'] = array();
            if ($user_id != null) {
                $result['posts'] = $this->addArrayToArray($result['posts'], $this->Post->findAllByUserId($user_id));
                $followers = $this->Post->User->Contact->find('all', array('conditions' => array('Contact.user_id' => $user_id)));
                foreach ($followers as $follower) {
                    $u_id = $follower['User']['id'];
                    $result['posts'] = $this->addArrayToArray($result['posts'], $this->Post->find('all', array('conditions' => array('Post.user_id' => $u_id, 'Post.group_id' => null))));
                }
                $groups = $this->Post->Group->GroupUser->findAllByUserId($user_id);
                foreach ($groups as $group) {
                    $group_id = $group['Group']['id'];
                    $result['posts'] = $this->addArrayToArray($result['posts'], $this->Post->find('all', array('conditions' => array('Post.group_id' => $group_id))));
                }
                usort($result['posts'], function ($a, $b) {
                    $ad = new DateTime($a['Post']['modified']);
                    $bd = new DateTime($b['Post']['modified']);

                    if ($ad == $bd) {
                        return 0;
                    }

                    return $ad < $bd ? 1 : -1;
                });
                $result['success'] = true;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
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
            $result['message'] = 'Invalid Request';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));

        }


    }

    public function getForUserProfile($id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $options = array('conditions' => array('Post.group_id' => null, 'Post.user_id' => $id));
            $posts = $this->Post->find('all', $options);
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
            $this->request->data['Post']['user_id'] = $this->Auth->user('id');

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
