<?php
App::uses('AppController', 'Controller');

/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController
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
        $this->Auth->allow('inboxSummary', 'getChat');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Message->recursive = 0;
        $this->set('messages', $this->Paginator->paginate());
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
        if (!$this->Message->exists($id)) {
            throw new NotFoundException(__('Invalid message'));
        }
        $options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
        $this->set('message', $this->Message->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Message->create();
            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash(__('The message has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The message could not be saved. Please, try again.'));
            }
        }
        $users = $this->Message->User->find('list');
        $this->set(compact('users'));
    }

    public function getChat()
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            if ($this->Auth->user('id') != null && $this->request->data['user_id'] == $this->Auth->user('id')) {
                $messages = $this->Message->getChat($this->request->data['user_id'], $this->request->data['contact_username']);
                $result['success'] = true;
                $result['messages'] = $messages;
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

    public function inboxSummary()
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            if ($this->Auth->user('id') != null) {
                $messages = $this->Message->getMessagesSummary($this->Auth->user('id'));
                $result['success'] = true;
                $result['users_messages'] = $messages;
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
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Message->exists($id)) {
            throw new NotFoundException(__('Invalid message'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Message->save($this->request->data)) {
                $this->Session->setFlash(__('The message has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The message could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
            $this->request->data = $this->Message->find('first', $options);
        }
        $users = $this->Message->User->find('list');
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
        $this->Message->id = $id;
        if (!$this->Message->exists()) {
            throw new NotFoundException(__('Invalid message'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Message->delete()) {
            $this->Session->setFlash(__('The message has been deleted.'));
        } else {
            $this->Session->setFlash(__('The message could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
