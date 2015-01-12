<?php
App::uses('AppController', 'Controller');

/**
 * Solutions Controller
 *
 * @property Solution $Solution
 * @property PaginatorComponent $Paginator
 */
class SolutionsController extends AppController
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
        $this->Auth->allow('add', 'delete', 'edit', 'getByTask');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Solution->recursive = 0;
        $this->set('solutions', $this->Paginator->paginate());
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
        if (!$this->Solution->exists($id)) {
            throw new NotFoundException(__('Invalid solution'));
        }
        $options = array('conditions' => array('Solution.' . $this->Solution->primaryKey => $id));
        $this->set('solution', $this->Solution->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Solution->create();
            if ($this->Solution->save($this->request->data)) {
                $result['message'] = 'Solution Successfully submitted.';
                $result['solution'] = $this->Solution->findById($this->Solution->id);
                $result['solution_id'] = $result['solution']['Solution']['id'];
                $result['success'] = true;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));

            } else {
                $result['message'] = 'Could not submit solution.';
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

    public function getByTask($id = null)
    {
        if ($this->request->is('post') || $this->request->is('get')) {
            if (!$this->Solution->Task->exists($id)) {
                $result['message'] = 'Invalid Task';
                $result['success'] = false;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                if ($this->Solution->Task->findById($id)['Group']['user_id'] == $this->Auth->user('id')) {
                    $solutions = $this->Solution->findAllByTaskId($id);
                    //$options = array('conditions' => array('Task.group_id' => $id, 'Solution.user_id' => $this->Auth->user('id')));
                    $result['solutions'] = $solutions;
                    $result['success'] = true;
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }else{
                    $u = $this->Auth->user();
                    $uid = $u['User']['id'];
                    $result['success'] = false;
                    $result['message'] = 'Not Authorized to access solutions';
                    $result['id'] = $this->Session->read('Auth.User');
                    $result['fromQ']=$this->Solution->Task->findById($id)['Group']['user_id'];
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                }

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
        if (!$this->Solution->exists($id)) {
            $result['message'] = 'Invalid solution.';
            $result['success'] = false;
            $this->set(array(
                'result' => $result,
                '_serialize' => array('result')
            ));
            return;
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Solution->save($this->request->data)) {
                $result['message'] = 'Solution Updated.';
                $result['solution_id'] = $id;
                $result['success'] = true;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            } else {
                $result['message'] = 'Could not update solution.';
                $result['success'] = false;
                $this->set(array(
                    'result' => $result,
                    '_serialize' => array('result')
                ));
            }
        } else {
            $result['message'] = 'Invalid Request.';
            $result['success'] = false;
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
        $this->Solution->id = $id;
        if (!$this->Solution->exists()) {
            throw new NotFoundException(__('Invalid solution'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Solution->delete()) {
            $this->Session->setFlash(__('The solution has been deleted.'));
        } else {
            $this->Session->setFlash(__('The solution could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
