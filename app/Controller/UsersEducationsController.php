<?php
App::uses('AppController', 'Controller');

/**
 * UsersEducations Controller
 *
 * @property UsersEducation $UsersEducation
 * @property PaginatorComponent $Paginator
 */
class UsersEducationsController extends AppController
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
        $this->Auth->allow('add', 'delete');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->UsersEducation->recursive = 0;
        $this->set('usersEducations', $this->Paginator->paginate());
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
        if (!$this->UsersEducation->exists($id)) {
            throw new NotFoundException(__('Invalid users education'));
        }
        $options = array('conditions' => array('UsersEducation.' . $this->UsersEducation->primaryKey => $id));
        $this->set('usersEducation', $this->UsersEducation->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->user('id') != null) {

                $options = array(
                    'conditions' => array(
                        'Education.institute' => $this->request->data['Education']['institute'],
                        'Education.major' => $this->request->data['Education']['major']
                    ));
                $temp = $this->UsersEducation->Education->find('first', $options);

                if ($temp == null || sizeof($temp) == 0) {
                    $this->UsersEducation->Education->create();
                    $this->UsersEducation->Education->save($this->request->data);
                    $education_id = $this->UsersEducation->Education->id;
                } else {
                    $education_id = $temp['Education']['id'];
                }

                $user_id = $this->Auth->user('id');

                $data['UsersEducation']['education_id'] = $education_id;
                $data['UsersEducation']['user_id'] = $user_id;
                $options = array(
                    'conditions' => array(
                        'UsersEducation.education_id' => $education_id,
                        'UsersEducation.user_id' => $user_id
                    ));
                $temp = $this->UsersEducation->find('first', $options);
                if ($temp == null || sizeof($temp) == 0) {
                    $this->UsersEducation->create();
                    if ($this->UsersEducation->save($data)) {
                        $result['success'] = true;
                        $result['user_education'] = $this->UsersEducation->findById($this->UsersEducation->id);
                        $result['message'] = 'Data Saved';
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    } else {
                        $result['success'] = false;
                        $result['message'] = 'Could not save data';
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    }
                } else {
                    $result['success'] = false;
                    $result['message'] = 'Data Already Exists';
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

        } else {
            $result['success'] = false;
            $result['message'] = 'Invalid request';
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
        if (!$this->UsersEducation->exists($id)) {
            throw new NotFoundException(__('Invalid users education'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->UsersEducation->save($this->request->data)) {
                $this->Session->setFlash(__('The users education has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The users education could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UsersEducation.' . $this->UsersEducation->primaryKey => $id));
            $this->request->data = $this->UsersEducation->find('first', $options);
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
        if ($this->request->is('delete')) {
            $education_id = $this->UsersEducation->Education->findById($id)['Education']['id'];
            if ($this->UsersEducation->deleteAll(array('UsersEducation.user_id' => $this->Auth->user('id'), 'UsersEducation.education_id' => $education_id))) {
                $result['success'] = true;
                $result['message'] = 'Education Deleted';
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
}
