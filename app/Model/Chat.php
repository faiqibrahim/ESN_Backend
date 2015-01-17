<?php
App::uses('AppModel', 'Model');

/**
 * Created by PhpStorm.
 * User: Ibrahim
 * Date: 1/16/15
 * Time: 1:58 PM
 */
class Chat extends AppModel
{

    public $validate = array(
        'id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        )
    );

    public $hasMany = array(
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'chat_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    public $hasAndBelongsToMany = array(
        'User' => array(
            'className' => 'User',
            'joinTable' => 'chats_users',
            'foreignKey' => 'chat_id',
            'associationForeignKey' => 'user_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

    public function getSummary($user_id = null)
    {
        if ($user_id == null) {
            return null;
        }
        $chats_users = $this->ChatsUser->findAllByUserId($user_id);
        $chat_ids = array();
        foreach ($chats_users as $chatUser) {
            array_push($chat_ids, $chatUser['ChatsUser']['chat_id']);
        }
        $chat_ids;
        $chats = $this->find('all', array(
            'conditions' => array('Chat.id' => $chat_ids)
        ));
        $results = array();
        $i = 0;
        foreach ($chats as $chat) {
            if (sizeof($chat['Message']) != 0) {
                $_message = $chat['Message'][sizeof($chat['Message']) - 1];
                $message = substr($_message['message'], 0, 20) . ' ...';
                $_message['message'] = $message;
                $results[$i]['Message'] = $_message;
            }
            $results[$i]['Chat'] = $chat['Chat'];
            if (isset($chat['User']) && sizeof($chat['User']) == 2) {
                if ($chat['User'][0]['id'] == $user_id) {
                    $contact = $chat['User'][1];
                    $user = $chat['User'][0];
                    $results[$i]['User'] = $user;
                    $results[$i]['Contact'] = $contact;
                } else {
                    $user = $chat['User'][1];
                    $contact = $chat['User'][0];
                    $results[$i]['User'] = $user;
                    $results[$i]['Contact'] = $contact;
                }
            }

            $i++;
        }
        return $results;

    }

    private function _getChatId($_users)
    {

        $users = $this->removeDuplicates($_users);
        $size = sizeof($users);
        if ($size > 1) {
            $options = array();
            $options['fields'] = array('ChatsUser.chat_id', 'COUNT(ChatsUser.chat_id) as Total');
            $options['conditions'] = array('ChatsUser.user_id' => $users);
            $options['group'] = array("ChatsUser.chat_id HAVING Total = $size");
            $result = $this->ChatsUser->find('all', $options);
            if (sizeof($result) != 0) {
                return $result[0]['ChatsUser']['chat_id'];
            } else {
                $this->create();
                $user['User'] = array();
                $i = 0;
                foreach ($users as $_user) {
                    $user['User'][$i] = $_user;
                }
                $data['User'] = $user;
                $this->save($data);
                return $this->id;
            }
        } else {
            return null;
        }
    }

    private function getChatId($user_id, $contact_id)
    {

        $db = $this->getDataSource();
        $chat_id = $db->fetchAll("SELECT chat_id from chats_users where user_id=? OR user_id=? group by chat_id having count(chat_id)=?",
            array($user_id, $contact_id, 2));

        if (sizeof($chat_id) != 0) {
            $chat_id = $chat_id[0]['chats_users']['chat_id'];
        } else {
            $chat_id = null;
            $this->create();
            $user['User'][0] = $user_id;
            $user['User'][1] = $contact_id;
            $data['User'] = $user;
            $this->save($data);
            $chat_id = $this->id;
        }
        return $chat_id;
    }

    public function getChat($user_id = null, $contact_username = null)
    {

        $result_messages = array();
        $contact = $this->Message->User->findByUsername($contact_username);
        if (sizeof($contact) == 0) {
            $contact_id = null;
        } else {
            $contact_id = $contact['User']['id'];
        }
        if ($user_id == $contact_id) {
            return null;
        }
        $this->_getChatId(array($user_id, $contact_id));
        if ($contact_id != null && $user_id != null) {
            $chat_id = $this->getChatId($user_id, $contact_id);

            $messages_id = array();
            $messages = $this->Message->MessagesUser->findAllByUserId($user_id);
            if (sizeof($messages) != 0) {
                foreach ($messages as $message) {
                    array_push($messages_id, $message['MessagesUser']['message_id']);
                }
                $chat_messages = $this->Message->find('all', array(
                    'conditions' => array(
                        'Message.id' => $messages_id,
                        'Message.chat_id' => $chat_id
                    ),
                    'order' => array('Message.created' => 'DESC'),
                    'limit' => 10
                ));

                foreach ($chat_messages as $message) {
                    array_unshift($result_messages, $message['Message']);
                }

            }


            $chat = $this->findById($chat_id);
            if (sizeof($result_messages) != 0) {
                $chat['Message'] = $result_messages;
            } else {
                $chat['Message'] = array();
            }
            return $chat;
        } else {
            return null;
        }
    }

    public function loadNext($data = null, $user_id = null)
    {
        if (!isset($data['Chat']['id']) || !isset($data['Message']['last_message']['id']) || $user_id == null) {
            return null;
        }
        $chat_id = $data['Chat']['id'];
        $last_message_id = $data['Message']['last_message']['id'];

        $messages_id = array();
        $messages = $this->Message->MessagesUser->findAllByUserId($user_id);
        if (sizeof($messages) != 0) {
            foreach ($messages as $message) {
                $message_id = $message['MessagesUser']['message_id'];
                if ($message_id > $last_message_id) {
                    array_push($messages_id, $message_id);
                }
            }

            $chat_messages = $this->Message->find('all', array(
                'conditions' => array(
                    'Message.id' => $messages_id,
                    'Message.chat_id' => $chat_id
                ),
                'order' => array('Message.created' => 'DESC'),
                'limit' => 10
            ));
            $result_messages = array();
            foreach ($chat_messages as $message) {
                array_push($result_messages, $message['Message']);
            }
            if ($result_messages == null) {
                return array();
            }
            return $result_messages;

        } else {
            return array();
        }

    }

    public function loadPrevious($data = null, $user_id = null)
    {
        if (!isset($data['Chat']['id']) || !isset($data['Message']['last_message']['id']) || $user_id == null) {
            return null;
        }
        $chat_id = $data['Chat']['id'];
        $last_message_id = $data['Message']['last_message']['id'];

        $messages_id = array();
        $messages = $this->Message->MessagesUser->findAllByUserId($user_id);
        if (sizeof($messages) != 0) {
            foreach ($messages as $message) {
                $message_id = $message['MessagesUser']['message_id'];
                if ($message_id < $last_message_id) {
                    array_push($messages_id, $message_id);
                }
            }

            $chat_messages = $this->Message->find('all', array(
                'conditions' => array(
                    'Message.id' => $messages_id,
                    'Message.chat_id' => $chat_id
                ),
                'order' => array('Message.created' => 'DESC'),
                'limit' => 10
            ));
            $result_messages = array();
            foreach ($chat_messages as $message) {
                array_push($result_messages, $message['Message']);
            }
            if ($result_messages == null) {
                return array();
            }
            return $result_messages;

        } else {
            return array();
        }

    }

    private function saveMessageForChatUsers($message_id, $chat_id)
    {
        $options = array('conditions' => array('Chat.' . $this->primaryKey => $chat_id));
        $chat = $this->find('first', $options);
        $users = $chat['User'];
        $i = 0;
        foreach ($users as $user) {
            $this->Message->MessagesUser->create();
            $saveData['MessagesUser']['message_id'] = $message_id;
            $saveData['MessagesUser']['user_id'] = $user['id'];
            $this->Message->MessagesUser->save($saveData);
        }

    }

    public function saveMessage($message = null, $user_id = null)
    {
        if ($message == null || $user_id == null || !isset($message['Message']['contact_id']) || !isset($message['Message']['message'])) {
            return $message;
        }
        $msg = $message['Message']['message'];
        $contact_id = $message['Message']['contact_id'];
        $chat_id = $this->getChatId($user_id, $contact_id);

        //update Chat modified date
        $updateChatData['Chat']['id'] = $chat_id;
        $this->id = $chat_id;
        $this->save($updateChatData);
        //save Message
        $messageSaveData['Message']['message'] = $msg;
        $messageSaveData['Message']['chat_id'] = $chat_id;
        $messageSaveData['Message']['user_id'] = $user_id;

        $this->Message->save($messageSaveData);
        //get Latest Added Message id
        $message_id = $this->Message->id;
        //save Message for All users
        $this->saveMessageForChatUsers($message_id, $chat_id);
        //Get Latest Added Message with details
        $result = $this->Message->findById($message_id)['Message'];
        if (sizeof($result) != 0) {
            return $result;
        } else {
            return null;
        }

    }

    public function deleteMessage($message_id, $user_id)
    {
        $options = array('MessagesUser.message_id' => $message_id, 'MessagesUser.user_id' => $user_id);
        return $this->Message->MessagesUser->deleteAll($options);
    }
}