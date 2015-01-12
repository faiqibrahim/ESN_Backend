<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController
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
        $this->User->recursive = 0;
        //$this->set('users', $this->Paginator->paginate());
        $users = $this->User->Post->find('all');
        $this->set(array(
            'users' => $users,
            '_serialize' => array('users')
        ));
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'addContact', 'edit', 'logout', 'deleteContact', 'checkUsername', 'checkEmail', 'login', 'isLoggedIn', 'addProfilePhoto', 'addCoverPhoto', 'deleteInterest', 'addInterest');
    }

    public function isLoggedin()
    {

        $this->set(array(
            'users' => $this->Auth->user(),
            '_serialize' => array('users')
        ));
        return;
    }

    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $result['success'] = true;
                $result['user'] = array('id' => $this->Auth->user('id'), 'username' => $this->Auth->user('username'));
                $result['message'] = 'Successfully Logged In';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
                return;
            } else {
                $result['success'] = false;
                $result['message'] = 'Username or Password Incorrect';
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
    /*
    public function login() {
        if ($this->Session->read('Auth.User')) {
            $this->set(array(
                'message' => array(
                    'text' => __('You are logged in!'),
                    'type' => 'error'
                ),
                '_serialize' => array('message')
            ));
        }

        if ($this->request->is('get')) {
            if ($this->Auth->login()) {
                // return $this->redirect($this->Auth->redirect());
                $this->set(array(
                    'user' => $this->Session->read('Auth.User'),
                    '_serialize' => array('user')
                ));
            } else {
                $this->set(array(
                    'message' => array(
                        'text' => __('Invalid username or password, try again'),
                        'type' => 'error'
                    ),
                    '_serialize' => array('message')
                ));
                $this->response->statusCode(401);
            }
        }
    }*/
    /*
        public function logout()
        {
            return $this->redirect($this->Auth->logout());
        }*/
    public function logout()
    {
        if ($this->Auth->logout()) {
            $this->set(array(
                'message' => array(
                    'text' => __('Logout successfully'),
                    'type' => 'info'
                ),
                '_serialize' => array('message')
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $users = $this->User->find('first', $options);
        $this->set(array(
            'users' => $users,
            '_serialize' => array('users')
        ));
    }

    public function getByUsername($username = null)
    {


        $options = array('conditions' => array('User.username' => $username));
        $users = $this->User->find('first', $options);
        $this->set(array(
            'users' => $users,
            '_serialize' => array('users')
        ));
    }

    /**
     * add method
     *
     * @return void
     */
    public function checkUsername()
    {
        if ($this->request->is('post')) {


            $username = $this->request->data['User']['username'];

            $len = $this->User->findByUsername($username);

            if (count($len) > 0) {
                $result['success'] = false;
                $result['message'] = 'Username not Available';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['success'] = true;
                $result['message'] = 'Username Available';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            }

        } else {
            $result['success'] = false;
            $result['message'] = 'Request Type not valid';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    public function checkEmail()
    {
        if ($this->request->is('post')) {
            $email = $this->request->data['email'];
            $len = $this->User->findByEmail($email);

            if (count($len) > 0) {
                $result['success'] = false;
                $result['message'] = 'Email already in use';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['success'] = true;
                $result['message'] = 'Email not in use';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Request Type not valid';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    function make_thumb($src, $dest, $desired_width, $desired_height)
    {

        /* read the source image */
        $source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        /* find the "desired height" of this thumbnail, relative to the desired width  */
        //$desired_height = floor($height * ($desired_width / $width));

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        imagejpeg($virtual_image, $dest);
    }

    private function savePhoto($width = '160', $height = '180', $fileType = 'profilePhoto')
    {

        if ($this->request->is('post')) {

            $data = array();

            if (isset($_FILES)) {

                $error = false;
                $files = array();
                $filePath = APP . 'webroot' . DS . 'img' . DS;

                foreach ($_FILES as $file) {
                    if (move_uploaded_file($file['tmp_name'], $filePath . basename($file['name']))) {
                        $src = $filePath . $file['name'];
                        $dest = $filePath . DS . 'thumbs' . DS . $file['name'];
                        $this->make_thumb($src, $dest, $width, $height);
                        $src = 'http://esnback.com/app/webroot/img/' . $file['name'];
                        $dest = 'http://esnback.com/app/webroot/img/' . 'thumbs' . '/' . $file['name'];
                        return array('success' => true, 'original' => $src, 'thumbnail' => $dest, 'fileType' => $fileType);

                    } else {
                        return array('success' => false, 'error' => $file['error']);
                    }
                }
            } else {
                return array('success' => false, 'error' => 'No Files Received');
            }
        } else {
            return array('success' => false, 'error' => 'Invalid Request Type');
        }
    }

    public function addProfilePhoto()
    {
        $result = $this->savePhoto();

        $this->set(array(
            'result' => $result,
            '_serialize' => array('result')
        ));
    }

    public function addCoverPhoto()
    {
        $result = $this->savePhoto('900', '500', 'coverPhoto');

        $this->set(array(
            'result' => $result,
            '_serialize' => array('result')
        ));
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            $role['Role'][0] = 2;
            $this->request->data['Role'] = $role;
            if ($this->User->save($this->request->data)) {
                $result['message'] = 'Registration Successful.';
                $result['success'] = true;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));

            } else {
                $result['message'] = 'Registration failed please try again.';
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
        /*
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$interests = $this->User->Interest->find('list');
		$roles = $this->User->Role->find('list');
		$this->set(compact('interests', 'roles'));*/
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
        if ($this->request->is(array('post', 'put'))) {
            // $id = $this->request->data['User']['id'];
            if (!$this->User->exists($id)) {
                $result['success'] = false;
                $result['message'] = 'Invalid User';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));

            } else {
                if ($this->Auth->user('id') == $id) {
                    if ($this->User->save($this->request->data)) {
                        //
                        $result['success'] = true;
                        $result['message'] = 'The user has been saved';
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    } else {
                        $result['success'] = false;
                        $result['message'] = 'The user has not been saved';
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    }
                } else {
                    $result['success'] = false;
                    $result['message'] = 'You are not authorized to perform this action';
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }
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

    public function deleteInterest($id = null)
    {
        if ($this->request->is('delete')) {
            if ($this->User->UsersInterest->deleteAll(array('UsersInterest.user_id' => $this->Auth->user('id'), 'UsersInterest.interest_id' => $id))) {
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
            $result['message'] = 'Invalid request type';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }


    }

    public function deleteContact($username = null)
    {
        if ($this->request->is('delete')) {
            $user = $this->User->findByUsername($username);
            $id = $user['User']['id'];
            if ($this->User->Contact->deleteAll(array('Contact.user_id' => $this->Auth->user('id'), 'Contact.user_id1' => $id))) {
                $result['success'] = true;
                $result['message'] = 'Connection Deleted';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));

            } else {
                $result['success'] = false;
                $result['message'] = 'Connection could not be deleted';
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

    public function addInterest()
    {
        if ($this->request->is('post')) {

            $interest_id = $this->request->data('interest_id');
            $user_id = $this->request->data('user_id');
            $this->User->UsersInterest->saveAll(array('user_id' => $user_id, 'interest_id' => $interest_id));
            $result['success'] = true;
            $result['message'] = 'Interest Added';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));

        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid request type';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    public function addContact()
    {
        if ($this->request->is('post')) {

            $user_id = $this->request->data('user_id');
            $user = $this->User->findByUsername($this->request->data['username']);
            $user_id1 = $user['User']['id'];
            if ($this->User->Contact->saveAll(array('user_id' => $user_id, 'user_id1' => $user_id1, 'contactrole_id' => '1'))) {
                $result['success'] = true;
                $result['message'] = 'Contact established';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['success'] = false;
                $result['message'] = 'Contact could not be established';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            };


        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid request type';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    public function getConnectionsTo()
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $options = array('conditions' => array('Contact.user_id1' => $this->Auth->user('id')));

            $users = $this->User->Contact->find('all', $options);
            $result_users = array();
            for ($i = 0; $i < sizeof($users); $i++) {
                array_push($result_users, $this->User->findById($users[$i]['Contact']['user_id']));
            }
            $result['success'] = true;
            $result['connections'] = $result_users;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid request type';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    public function getConnectionsFrom()
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $options = array('conditions' => array('Contact.user_id' => $this->Auth->user('id')));
            $users = $this->User->Contact->find('all', $options);

            $result['success'] = true;
            $result['connections'] = $users;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid request type';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    public function areConnected($user_id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $options = array('conditions' => array('Contact.user_id' => $this->Auth->user('id'), 'Contact.user_id1' => $user_id));
            $users = $this->User->Contact->find('first', $options);
            if (sizeof($users) > 0) {
                $result['success'] = true;
                $result['message'] = 'Contact established';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['success'] = false;
                $result['message'] = 'Contact is not established';
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            };


        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid request type';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    public function getJoinedGroups($username = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            $user = $this->User->findByUsername($username);
            $user_id = $user['User']['id'];
            $groups = $this->User->Group->GroupUser->findAllByUserId($user_id);
            $result['success'] = true;
            $result['groups'] = $groups;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));

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

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
