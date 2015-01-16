<?php
App::uses('AppController', 'Controller');

/**
 * Contents Controller
 *
 * @property Content $Content
 * @property PaginatorComponent $Paginator
 */
class ContentsController extends AppController
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
        $this->Auth->allow('uploadFile');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Content->recursive = 0;
        //$this->set('users', $this->Paginator->paginate());
        $users = $this->Content->find('all');
        $this->set(array(
            'contents' => $users,
            '_serialize' => array('contents')
        ));
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
        if (!$this->Content->exists($id)) {
            throw new NotFoundException(__('Invalid content'));
        }
        $options = array('conditions' => array('Content.' . $this->Content->primaryKey => $id));
        $this->set('content', $this->Content->find('first', $options));
    }

    private function saveFile()
    {
        if ($this->request->is('post')) {

            $data = array();

            if (isset($_FILES) && sizeof($_FILES) > 0) {

                $error = false;
                $files = array();
                $filePath = APP . 'webroot' . DS . 'files' . DS;
                $user_info = $this->Auth->user('id') . '_';
                foreach ($_FILES as $file) {

                    if (move_uploaded_file($file['tmp_name'], $filePath . $user_info . basename($file['name']))) {
                        $src = 'http://esnback.com/app/webroot/files/' . $user_info . $file['name'];
                        return array('success' => true, 'filePath' => $src);

                    } else {
                        return array('success' => false, 'error' => 'Could not move file');
                    }
                }
            } else {
                return array('success' => false, 'error' => 'No Files Received');
            }
        } else {
            return array('success' => false, 'error' => 'Invalid Request Type');
        }
    }

    public function uploadFile()
    {
        if ($this->Auth->user('id') != null) {
            $savePath = $this->saveFile();
            $contentPath = null;

            if ($savePath['success']) {

                $contentPath = $savePath['filePath'];
                $options = array('conditions' => array('Content.content' => $contentPath));
                $existing_content = $this->Content->find('first', $options);

                if (isset($existing_content['Content']['content'])) {
                    $existing_id = $existing_content['Content']['id'];
                    $result['success'] = true;
                    $result['content_id'] = $existing_id;
                    $result['content_path'] = $existing_content['Content']['content'];
                    $this->set(array(
                        'result' => $result,
                        '_serialize' => array('result')
                    ));
                } else {
                    $data['Content']['content'] = $contentPath;
                    $data['Content']['contenttype_id'] = '3';
                    if ($this->Content->save($data)) {
                        $result['success'] = true;
                        $result['content_id'] = $this->Content->id;
                        $result['content_path'] = $contentPath;
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    } else {
                        $result['success'] = false;
                        $result['message'] = 'Could not save content';
                        $this->set(array(
                            'result' => $result,
                            '_serialize' => array('result')
                        ));
                    }
                }


            } else {
                $result['success'] = false;
                $result['message'] = 'Error, '.$savePath['error'];
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

    /**
     * add method
     *
     * @return void
     */


    public function add()
    {
        if ($this->request->is('post')) {
            $this->Content->create();
            if ($this->Content->save($this->request->data)) {
                $this->Session->setFlash(__('The content has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The content could not be saved. Please, try again.'));
            }
        }
        $contenttypes = $this->Content->Contenttype->find('list');
        $posts = $this->Content->Post->find('list');
        $tasks = $this->Content->Task->find('list');
        $solutions = $this->Content->Solution->find('list');
        $contentprivacies = $this->Content->Contentprivacy->find('list');
        $groupcontents = $this->Content->Groupcontent->find('list');
        $this->set(compact('contenttypes', 'posts', 'tasks', 'solutions', 'contentprivacies', 'groupcontents'));
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
        if (!$this->Content->exists($id)) {
            throw new NotFoundException(__('Invalid content'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Content->save($this->request->data)) {
                $this->Session->setFlash(__('The content has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The content could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Content.' . $this->Content->primaryKey => $id));
            $this->request->data = $this->Content->find('first', $options);
        }
        $contenttypes = $this->Content->Contenttype->find('list');
        $posts = $this->Content->Post->find('list');
        $tasks = $this->Content->Task->find('list');
        $solutions = $this->Content->Solution->find('list');
        $contentprivacies = $this->Content->Contentprivacy->find('list');
        $groupcontents = $this->Content->Groupcontent->find('list');
        $this->set(compact('contenttypes', 'posts', 'tasks', 'solutions', 'contentprivacies', 'groupcontents'));
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
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException(__('Invalid content'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Content->delete()) {
            $this->Session->setFlash(__('The content has been deleted.'));
        } else {
            $this->Session->setFlash(__('The content could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
