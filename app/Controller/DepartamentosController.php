<?php

App::uses('AppController', 'Controller');

/**
 * Departamentos Controller
 *
 * @property Departamento $Departamento
 * @property PaginatorComponent $Paginator
 */
class DepartamentosController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    function beforeFilter() {
        parent::beforeFilter();
        if($this->Auth->user('grupo_id') != 1){
            $this->Session->setFlash('Página não encontrada', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException;
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Departamento->recursive = 0;
        $this->set('departamentos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Departamento->exists($id)) {
            $this->Session->setFlash('ID ' . $id . ' inexistente', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException;
        }
        $options = array('conditions' => array('Departamento.' . $this->Departamento->primaryKey => $id));
        $this->set('departamento', $this->Departamento->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Departamento->create();
            if ($this->Departamento->save($this->request->data)) {
                $this->Session->setFlash('O novo departamento foi adicionado', 'flash/custom', array('class' => 'flash_success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('O departamento não pode ser salvo', 'flash/custom', array('class' => 'flash_error'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Departamento->exists($id)) {
            $this->Session->setFlash('ID ' . $id . ' inexistente', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException;
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Departamento->save($this->request->data)) {
                $this->Session->setFlash('O departamento foi editado', 'flash/custom', array('class' => 'flash_success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('O departamento não pode ser editado', 'flash/custom', array('class' => 'flash_error'));
            }
        } else {
            $options = array('conditions' => array('Departamento.' . $this->Departamento->primaryKey => $id));
            $this->request->data = $this->Departamento->find('first', $options);
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
        $this->Departamento->id = $id;
        if (!$this->Departamento->exists()) {
            $this->Session->setFlash('ID ' . $id . ' inexistente', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException;
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Departamento->delete()) {
            $this->Session->setFlash('O departamento foi excluído', 'flash/custom', array('class' => 'flash_info'));
        } else {
            $this->Session->setFlash('O departamento não pode ser deletado', 'flash/custom', array('class' => 'flash_error'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
