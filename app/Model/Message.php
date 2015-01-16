<?php
App::uses('AppModel', 'Model');

/**
 * Message Model
 *
 * @property User $User
 */
class Message extends AppModel
{

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'chat_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Chat' => array(
            'className' => 'Chat',
            'foreignKey' => 'chat_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public $hasAndBelongsToMany = array(
        'User' => array(
            'className' => 'User',
            'joinTable' => 'messages_users',
            'foreignKey' => 'message_id',
            'associationForeignKey' => 'message_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

    public function getChat($user_id = null, $contact_username = null)
    {
        if ($user_id == null || $contact_username == null) {
            return null;
        }
        $contact_id = $this->User->findByUsername($contact_username)['User']['id'];
        $options = array(

            "OR" => array(
                array(
                    "Message.user_id" => $user_id,
                    "Message.user_id1" => $contact_id
                ),
                array(
                    "Message.user_id1" => $user_id,
                    "Message.user_id" => $contact_id
                )


            )
        );
        $result = array();

        $messages = $this->find('all', array('conditions' => $options));

        return $messages;
    }

    public function getMessagesSummary($id = null)
    {
        if ($id == null) {
            return null;
        }

        $options = array(

            "OR" => array(
                'Message.user_id' => $id,
                'Message.user_id1' => $id
            )
        );
        $result = array();

        $messages = $this->find('all', array('conditions' => $options, 'order' => array('Message.id' => 'desc')));

        if ($messages != null && sizeof($messages) > 0) {
            $result['users_messages'] = array();
            $i = 0;
            $filter = array();
            foreach ($messages as $message) {
                $_key = $message['Message']['user_id'] . '_' . $message['Message']['user_id1'];
                $key_ = $message['Message']['user_id1'] . '_' . $message['Message']['user_id'];
                if (isset($filter[$_key]) || isset($filter[$key_])) {
                    //do nothing
                } else {
                    $filter[$_key] = true;
                    $filter[$key_] = true;
                    $message['Message']['message'] = substr($message['Message']['message'], 0, 50) . '...';
                    if ($id == $message['Message']['user_id']) {
                        $result['users_messages'][$i] = (object)array(
                            'Message' => $message['Message'],
                            'User' => $this->User->findById($message['Message']['user_id'])['User'],
                            'Contact' => $this->User->findById($message['Message']['user_id1'])['User']
                        );
                    } else {
                        $result['users_messages'][$i] = (object)array(
                            'Message' => $message['Message'],
                            'User' => $this->User->findById($message['Message']['user_id1'])['User'],
                            'Contact' => $this->User->findById($message['Message']['user_id'])['User']
                        );
                    }

                    $i++;
                }


            }
            return $result['users_messages'];

        }

        return $result;

    }
}
