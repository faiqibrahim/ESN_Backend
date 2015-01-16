<?php
App::uses('AppController', 'Controller');
/**
 * Chats Controller
 *
 * @property Chat $Chat
 */

/**
 * Created by PhpStorm.
 * User: Ibrahim
 * Date: 1/16/15
 * Time: 2:17 PM
 */
class ChatsController extends AppController
{
    /**
     * Components
     *
     * @var array
     */
    public $components = array('RequestHandler');


    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('addMessage', 'getChat', 'loadPrevious', 'loadNext', 'deleteMessage');
    }

    public function loadPrevious()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->user('id') != null) {
                $msgs = $this->Chat->loadPrevious($this->request->data, $this->Auth->user('id'));
                if (sizeof($msgs) != 0) {
                    $result['messages'] = $msgs;
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['messages'] = array();
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

    public function loadNext()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->user('id') != null) {
                $msgs = $this->Chat->loadNext($this->request->data, $this->Auth->user('id'));
                if (sizeof($msgs) != 0) {
                    $result['messages'] = $msgs;
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['messages'] = array();
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

    public function addMessage()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->user('id') != null) {
                $msg = $this->Chat->saveMessage($this->request->data, $this->Auth->user('id'));
                if ($msg != null) {
                    $result['Message'] = $msg;
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $result['message'] = "Invalid Arguments";
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


    public function getChat($contact_username = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            if ($this->Auth->user('id') != null) {
                if ($contact_username != null) {
                    $chat = $this->Chat->getChat($this->Auth->user('id'), $contact_username);
                    if ($chat != null) {
                        $result['chat'] = $chat;
                        $result['success'] = true;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    } else {
                        $result['message'] = "Invalid Arguments";
                        $result['success'] = false;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    }

                } else {
                    $result['message'] = 'No Contact specified';
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

    public function deleteMessage($id = null)
    {
        if ($this->request->is('delete')) {
            if ($this->Auth->user('id') != null) {
                $this->Chat->Message->id = $id;
                if ($id != null && $this->Chat->Message->exists()) {
                    $deleted = $this->Chat->deleteMessage($id, $this->Auth->user('id'));
                    if ($deleted) {
                        $result['message'] = 'Message Deleted';
                        $result['success'] = true;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    } else {
                        $result['message'] = "Invalid Arguments";
                        $result['success'] = false;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    }

                } else {
                    $result['message'] = 'Invalid Message specified';
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


} 