<?php

App::uses('AppController', 'Controller');

/**
 * Equipamentos Controller
 *
 * @property Equipamento $Equipamento
 * @property PaginatorComponent $Paginator
 */
class EquipamentosController extends AppController {

    function beforeFilter() {
        parent::beforeFilter();
        if ($this->Auth->user('grupo_id') != 1) {
            $this->setFlash('Página não encontrada', 'flash_error');
            throw new NotFoundException;
        }
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
        $this->Equipamento->recursive = 0;
        $this->set('equipamentos', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Equipamento->exists($id)) {
            $this->setFlash('ID ' . $id . ' inexistente', 'flash_error');
            throw new NotFoundException;
        }
        $options = array('conditions' => array('Equipamento.' . $this->Equipamento->primaryKey => $id));
        $this->set('equipamento', $this->Equipamento->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Equipamento->create();
            if ($this->Equipamento->save($this->request->data)) {
                $this->setFlash('O novo equipamento foi salvo', 'flash_success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->setFlash('O novo equipamento nao pode ser salvo', 'flash_error');
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
        if (!$this->Equipamento->exists($id)) {
            $this->setFlash('ID ' . $id . ' inexistente', 'flash_error');
            throw new NotFoundException;
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Equipamento->save($this->request->data)) {
                $this->setFlash('O equipamento foi editado', 'flash_success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->setFlash('O equipamento não pode ser editado', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Equipamento.' . $this->Equipamento->primaryKey => $id));
            $this->request->data = $this->Equipamento->find('first', $options);
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
        $this->Equipamento->id = $id;
        if (!$this->Equipamento->exists()) {
            $this->setFlash('ID ' . $id . ' inexistente', 'flash_error');
            throw new NotFoundException;
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Equipamento->delete()) {
            $this->setFlash('O equipamento foi excluído', 'flash_info');
        } else {
            $this->setFlash('O equipamento não pode ser excluído', 'flash_error');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
