<?php

App::uses('AppController', 'Controller');

/**
 * Requisicoes Controller
 *
 * @property Requisicao $Requisicao
 * @property PaginatorComponent $Paginator
 */
class RequisicoesController extends AppController {

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
    public function index($situacao = null) {
        if ($situacao != null) {
            $conditionSituacao['situacao_id'] = $situacao;
        } else {
            $conditionSituacao = null;
        }
        $this->Requisicao->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => array(
                'Requisicao.created' => 'asc',
                'Requisicao.modified' => 'asc'
            )
        );
        switch ($this->Auth->user('grupo_id')) {
            //Técnicos veem requisições de todo mundo
            case 1:
                if ($this->request->is('post')) {
                    $conditionDepartamento['departamento_id'] = $this->request->data['departamento']['departamento_id'];
                } else {
                    $conditionDepartamento = null;
                }
                $requisicoes = $this->Paginator->paginate(
                        array(
                            $conditionSituacao,
                            $conditionDepartamento
                        )
                );
                $departamentos = $this->Requisicao->Departamento->find('list');
                $this->set(compact('departamentos'));
                break;
            //Usuários comuns veem apenas suas próprias requisições
            case 2:
                $requisicoes = $this->Paginator->paginate(
                        array(
                            'requisitante_id' => $this->Auth->user('id'),
                            $conditionSituacao,
                        )
                );
                break;
        }
        $this->set(compact('requisicoes'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Requisicao->exists($id)) {
            $this->Session->setFlash('ID ' . $id . ' inexistente', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException;
        }
        $options = array('conditions' => array('Requisicao.' . $this->Requisicao->primaryKey => $id));
        $requisicao = $this->Requisicao->find('first', $options);
        if ($this->Auth->user('grupo_id') == 1 || $requisicao['Requisicao']['requisitante_id'] == $this->Auth->user('id')) {
            $this->set(compact('requisicao'));
        } else {
            $this->Session->setFlash('Você não tem permissão para acessar esta requisição', 'flash/custom', array('class' => 'flash_error'));
            throw new MethodNotAllowedException();
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Requisicao->create();
            $this->request->data['Requisicao']['requisitante_id'] = $this->Auth->user('id');
            if ($this->Requisicao->save($this->request->data)) {
                $this->Session->setFlash('A requisição foi salva com sucesso', 'flash/custom', array('class' => 'flash_success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('A requisição não pode ser salva', 'flash/custom', array('class' => 'flash_error'));
            }
        }
        $departamentos = $this->Requisicao->Departamento->find('list');
        $equipamentos = $this->Requisicao->Equipamento->find('list');
        $this->set(compact('departamentos', 'equipamentos'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Requisicao->exists($id)) {
            $this->Session->setFlash('ID ' . $id . ' inexistente', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException;
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Requisicao->save($this->request->data)) {
                $this->Session->setFlash('A requisição foi salva com sucesso', 'flash/custom', array('class' => 'flash_success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('A requisição nao pode ser editada', 'flash/custom', array('class' => 'flash_error'));
            }
        } else {
            $options = array('conditions' => array('Requisicao.' . $this->Requisicao->primaryKey => $id));
            $requisicao = $this->Requisicao->find('first', $options);
            if ($this->Auth->user('grupo_id') == 1 || $requisicao['Requisicao']['requisitante_id'] == $this->Auth->user('id')) {
                $this->request->data = $requisicao;
            } else {
                $this->Session->setFlash('Você não tem permissão para editar esta requisição', 'flash/custom', array('class' => 'flash_error'));
                throw new MethodNotAllowedException();
            }
        }
        if ($this->Auth->user('grupo_id') == 1) {
            $situacoes = $this->Requisicao->Situacao->find('list');
            $tecnicos = $this->Requisicao->Tecnico->find('list', array('conditions' => array('grupo_id' => '1')));
            $this->set(compact('situacoes', 'tecnicos'));
        }
        $departamentos = $this->Requisicao->Departamento->find('list');
        $equipamentos = $this->Requisicao->Equipamento->find('list');
        $this->set(compact('departamentos', 'equipamentos'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->Requisicao->exists($id)) {
            $this->Session->setFlash('ID ' . $id . ' inexistente', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException;
        }

        $options = array('conditions' => array('Requisicao.' . $this->Requisicao->primaryKey => $id));
        $requisicao = $this->Requisicao->find('first', $options);
        if ($this->Auth->user('grupo_id') != 1 && $requisicao['Requisicao']['requisitante_id'] != $this->Auth->user('id')) {
            $this->Session->setFlash('Você não tem permissão para cancelar esta requisição', 'flash/custom', array('class' => 'flash_error'));
            throw new MethodNotAllowedException();
        }

        $this->request->allowMethod('post', 'delete');
        $this->request->data['Requisicao']['situacao_id'] = 3;
        $this->request->data['Requisicao']['id'] = $id;
        if ($this->Requisicao->save($this->request->data)) {
            $this->Session->setFlash('A requisição foi cancelada', 'flash/custom', array('class' => 'flash_info'));
        } else {
            $this->Session->setFlash('A requisição nao pode ser cancelada', 'flash/custom', array('class' => 'flash_error'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
