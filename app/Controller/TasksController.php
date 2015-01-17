<?php
App::uses('AppController', 'Controller');

/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property PaginatorComponent $Paginator
 */
class TasksController extends AppController
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
        $this->Task->recursive = 0;
        $this->set('tasks', $this->Paginator->paginate());
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add', 'delete', 'getByGroup', 'getTime');
    }

    public function getTime()
    {
        if ($this->request->is('get')) {
            $result['server_time'] = new DateTime();
            $result['success'] = true;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        } else {
            $result['message'] = 'Invalid Request';
            $result['success'] = false;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
        }
    }

    public function getByGroup($id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            if (!$this->Task->Group->exists($id)) {
                $result['message'] = 'Invalid Task';
                $result['success'] = false;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $options = array(
                    'conditions' => array('Task.group_id' => $id),
                    'order' => array('Task.created' => 'DESC')
                );

                $tasks = $this->Task->find('all', $options);
                $options = array('conditions' => array('Task.group_id' => $id, 'Solution.user_id' => $this->Auth->user('id')));
                $solution = $this->Task->Solution->find('all', $options);
                for ($i = 0; $i < sizeof($tasks); $i++) {
                    $solutions = $tasks[$i]['Solution'];
                    for ($j = 0; $j < sizeof($solutions); $j++) {
                        $solution = $solutions[$j];
                        if ($solution['user_id'] == $this->Auth->user('id')) {
                            $tasks[$i]['Solution'] = $solution;
                            break;
                        } else {
                            unset($tasks[$i]['Solution'][$j]);

                        }

                    }

                }
                $result['tasks'] = $tasks;
                $result['success'] = true;
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
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Task->exists($id)) {
            throw new NotFoundException(__('Invalid task'));
        }
        $options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
        $this->set('task', $this->Task->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Task->create();
            if ($this->Task->save($this->request->data)) {
                $result['message'] = 'Task Successfully Created.';
                $result['task'] = $this->Task->findById($this->Task->id);
                $result['success'] = true;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));

            } else {
                $result['message'] = 'Could not create task.';
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
    public function edit($id = null)
    {
        if (!$this->Task->exists($id)) {
            throw new NotFoundException(__('Invalid task'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Task->save($this->request->data)) {
                $this->Session->setFlash(__('The task has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The task could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
            $this->request->data = $this->Task->find('first', $options);
        }
        $groups = $this->Task->Group->find('list');
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
        $this->Task->id = $id;
        if (!$this->Task->exists()) {
            throw new NotFoundException(__('Invalid task'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Task->delete()) {
            $this->Session->setFlash(__('The task has been deleted.'));
        } else {
            $this->Session->setFlash(__('The task could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
