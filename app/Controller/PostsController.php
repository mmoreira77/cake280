<?php

class PostsController extends AppController {

    public $helpers = array('Html', 'Form');

    //public $components = array('Flash');

    function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = NULL) {
        $this->set('post', $this->Post->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success('Tu articulo fue guardado');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = NULL) {
        if (!$id) {
            throw new NotFoundException(__('Post invalido'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Post invalida'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->sucess(__('Your post has been updated'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

}
