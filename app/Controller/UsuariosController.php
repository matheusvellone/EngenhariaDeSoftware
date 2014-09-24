<?php

App::uses('AppController', 'Controller');

/**
 * Usuarios Controller
 *
 * @property Usuario $Usuario
 * @property PaginatorComponent $Paginator
 */
class UsuariosController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'add', 'logout');
    }

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Usuario->recursive = 0;
        $this->set('usuarios', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Usuario->exists($id)) {
            $this->Session->setFlash('ID ' . $id . ' inexistente', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException(404);
        }
        $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
        $this->set('usuario', $this->Usuario->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            //Uma pessoa que nao seja técnico nao pode criar cadastro de outros técnicos
            if ($this->request->data['Usuario']['grupo_id'] == 1 && $this->Auth->user('grupo_id') != 1) {
                $this->Session->setFlash('Você não tem permissão para criar um cadastro de Técnicos', 'flash/custom', array('class' => 'flash_info'));
                $grupos = $this->Usuario->Grupo->find('list');
                $this->set(compact('grupos'));
                return;
            }
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash('O usuário foi salvo com sucesso', 'flash/custom', array('class' => 'flash_success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Não foi possível efetuar o cadastro. Por favor confirme se não existem erros no cadastro', 'flash/custom', array('class' => 'flash_error'));
            }
        }
        $grupos = $this->Usuario->Grupo->find('list');
        $this->set(compact('grupos'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit() {
        $id = $this->Auth->user('id');
        if (!$this->Usuario->exists($id)) {
            $this->Session->setFlash('ID '.$id.' inexistente. Tente realizar o login novamente.', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException(404);
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash('O usuário foi editado com sucesso', 'flash/custom', array('class' => 'flash_success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('O usuário não pode ser editado', 'flash/custom', array('class' => 'flash_error'));
            }
        } else {
            $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
            $this->request->data = $this->Usuario->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException('Invalid usuario');
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Usuario->delete()) {
            $this->Session->setFlash('O usuário foi deletado com sucesso', 'flash/custom', array('class' => 'flash_info'));
        } else {
            $this->Session->setFlash('O usuário não pode ser deletado', 'flash/custom', array('class' => 'flash_error'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->loginRedirect);
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash('Login efetuado com sucesso', 'flash/custom', array('class' => 'flash_success'));
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash('Usuário ou Senha incorreto', 'flash/custom', array('class' => 'flash_error'));
        }
    }

    public function logout() {
        $this->Session->setFlash('Logout efetuado com sucesso', 'flash/custom', array('class' => 'flash_info'));
        $this->redirect($this->Auth->logout());
    }

}
