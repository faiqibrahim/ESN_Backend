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
        $users = $this->User->find('all');
        $this->set(array(
            'users' => $users,
            '_serialize' => array('users')
        ));
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'logout', 'checkUsername', 'checkEmail', 'login');
    }


    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $result['success'] = true;
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

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
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
        $this->set('user', $this->User->find('first', $options));
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

        }
        else {
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
        }
        else{
            $result['success'] = false;
            $result['message'] = 'Request Type not valid';
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $interests = $this->User->Interest->find('list');
        $roles = $this->User->Role->find('list');
        $this->set(compact('interests', 'roles'));
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
