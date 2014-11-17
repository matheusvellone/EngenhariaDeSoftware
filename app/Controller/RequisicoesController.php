<?php

App::uses('AppController', 'Controller');
App::import('Vendor', 'mpdf/mpdf');

/**
 * Requisicoes Controller
 *
 * @property Requisicao $Requisicao
 * @property PaginatorComponent $Paginator
 */
class RequisicoesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('android');
    }

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'HighCharts.HighCharts', 'RequestHandler');

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
                if ($this->request->query['departamento_id'] != null) {
                    $conditionDepartamento['departamento_id'] = $this->request->query['departamento_id'];
                    $this->set('departamento', $conditionDepartamento['departamento_id']);
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
            case 2: case 3: case 4:
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
            $this->setFlash('ID ' . $id . ' inexistente', 'flash_error');
            throw new NotFoundException;
        }
        $options = array('conditions' => array('Requisicao.' . $this->Requisicao->primaryKey => $id));
        $requisicao = $this->Requisicao->find('first', $options);
        if ($this->Auth->user('grupo_id') == 1 || $requisicao['Requisicao']['requisitante_id'] == $this->Auth->user('id')) {
            $this->set(compact('requisicao'));
        } else {
            $this->setFlash('Você não tem permissão para acessar esta requisição', 'flash_error');
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
                $this->setFlash('A requisição foi salva com sucesso', 'flash_success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->setFlash('A requisição não pode ser salva', 'flash_error');
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
            $this->setFlash('ID ' . $id . ' inexistente', 'flash_error');
            throw new NotFoundException;
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Requisicao->save($this->request->data)) {

                //Se quem editou a Requisição for um técnico, envia um email para a pessoa
                if ($this->Auth->user('grupo_id') == 1) {
                    $data = new DateTime();
                    $dia = $data->format('d-m-Y');
                    $hora = $data->format('H:i:s');
                    $dados = $this->Requisicao->find('first', array('conditions' => array('Requisicao.' . $this->Requisicao->primaryKey => $this->request->data['Requisicao']['id'])));
                    $dados['Respondeu'] = $this->Auth->user();
                    $dados['Data']['hora'] = $hora;
                    $dados['Data']['dia'] = $dia;
//                    die(debug($dados));
                    App::uses('CakeEmail', 'Network/Email');
                    $cake_email = new CakeEmail('gmail');
                    $cake_email->emailFormat('html');
                    $cake_email->to($dados['Requisitante']['email']);
                    $cake_email->template('atualizacaoRequisicao', 'default');
                    $cake_email->subject('ATUALIZAÇÃO DE REQUISICÃO');

                    $cake_email->viewVars(array('dados' => $dados));
                    try {
                        $cake_email->send();
                    } catch (Exception $ex) {
                        $this->setFlash('A requisição foi alterada, porém o email não foi enviado (' . $ex->getMessage() . ')<br>Você pode atualizar a requisição novamente para tentar reenviar o email', 'flash_info');
                        return $this->redirect(array('action' => 'edit', $dados['Requisicao']['id']));
                    }
                    $this->setFlash('A requisição foi salva e o email notificando a alteração foi enviado para ' . $dados['Requisitante']['email'], 'flash_success');
                } else {
                    $this->setFlash('A requisição foi salva com sucesso', 'flash_success');
                }

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->setFlash('A requisição nao pode ser editada', 'flash_error');
            }
        } else {
            $options = array('conditions' => array('Requisicao.' . $this->Requisicao->primaryKey => $id));
            $requisicao = $this->Requisicao->find('first', $options);
            if ($requisicao['Requisicao']['situacao_id'] == 2 || $requisicao['Requisicao']['situacao_id'] == 3) {
                $this->setFlash('Esta requisição está ' . $requisicao['Situacao']['situacao'] . '. Não é possível editá-la.', 'flash_info');
                return $this->redirect(array('controller' => 'Requisicoes', 'action' => 'view', $requisicao['Requisicao']['id']));
            }
            if ($this->Auth->user('grupo_id') == 1 || $requisicao['Requisicao']['requisitante_id'] == $this->Auth->user('id')) {
                $this->request->data = $requisicao;
            } else {
                $this->setFlash('Você não tem permissão para editar esta requisição.', 'flash_error');
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
            $this->setFlash('ID ' . $id . ' inexistente', 'flash_error');
            throw new NotFoundException;
        }

        $options = array('conditions' => array('Requisicao.' . $this->Requisicao->primaryKey => $id));
        $requisicao = $this->Requisicao->find('first', $options);
        if ($this->Auth->user('grupo_id') != 1 && $requisicao['Requisicao']['requisitante_id'] != $this->Auth->user('id')) {
            $this->setFlash('Você não tem permissão para cancelar esta requisição', 'flash_error');
            throw new MethodNotAllowedException();
        }
        $this->request->data['Requisicao']['situacao_id'] = 3;
        $this->request->data['Requisicao']['id'] = $id;
        if ($this->Requisicao->save($this->request->data)) {
            $this->setFlash('A requisição foi cancelada', 'flash_info');
        } else {
            $this->setFlash('A requisição nao pode ser cancelada', 'flash_error');
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function android() {
        $fields = array(
            'Requisitante.nome',
            'Departamento.nome',
            'Equipamento.nome',
            'Requisicao.created'
        );
        $requisicoes = $this->Requisicao->find('all', array(
            'fields' => $fields,
            'conditions' => array(
                'Situacao.id' => '0'
            )
        ));
        if ($requisicoes != null) {
            $status = 1;
        } else {
            $status = 0;
        }
        $this->set(compact('requisicoes', 'status'));
        $this->set('_serialize', array('status', 'requisicoes'));
    }

    public function historico() {
        if ($this->Auth->user('grupo_id') != 1) {
            return $this->redirect(array('controller' => 'Requisicoes', 'action' => 'index'));
        }
        $this->Requisicao->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => array(
                'Requisicao.created' => 'asc',
                'Requisicao.modified' => 'asc'
            ),
            'conditions' => array(
                'tecnico_id' => $this->Auth->user('id')
            )
        );
        $requisicoes = $this->Paginator->paginate();
        $this->set(compact('requisicoes', 'departamentos'));
    }

    public function relatorio() {

        if ($this->request->is('post', 'put')) {
            foreach ($this->request->data['Requisicao'] as $campo_nome => $campo_valor) {
                if ($campo_valor != null) {
                    $conditions[$campo_nome] = $campo_valor;
                }
            }
            $requisicoes = $this->Requisicao->find('all', array(
                'conditions' => $conditions,
                'order' => array(
                    'Requisicao.created'
                )
            ));
//            debug($requisicoes);
//            die;
            $numeroRequisicoes = count($requisicoes);
            $this->set(compact('requisicoes', 'numeroRequisicoes'));
            $data = new DateTime();
            $dia = $data->format('d-m-Y');
            $hora = $data->format('H:i:s');
            $mpdf = new mPDF();
//            $this->layout = NULL;
            $response = $this->render('relatorioPDF');
            $thebody = $response->body();
            $header = '<div class="text-center">Relatório do Técnico ' . $this->Auth->user('nome') . '</div>';
            $footer = '<div class="col-md-6">Relatório gerado dia ' . $dia . ' às ' . $hora . ' - Página {PAGENO} de {nbpg}</div>';
            $mpdf->setHTMLHeader($header);
            $mpdf->SetHTMLFooter($footer);
            $mpdf->WriteHTML($thebody);
            $nome_arquivo = 'Relatorio-' . $dia . '_' . $hora . '.pdf';

            $mpdf->Output($nome_arquivo, "I"); //mudar para I e não D
        }
        $equipamentos = $this->Requisicao->Equipamento->find('list');
        $tecnicos = $this->Requisicao->Tecnico->find('list', array('conditions' => array('grupo_id' => '1')));
        $departamentos = $this->Requisicao->Departamento->find('list');
        $this->set(compact('departamentos', 'tecnicos', 'equipamentos'));
    }

    public function estatisticas() {
        $array_chart = array();
        $dados['total'] = $this->Requisicao->find('count');
        $dados['meus'] = $this->Requisicao->find('count', array('conditions' => array('tecnico_id' => $this->Auth->user('id'))));

        $equipamentos = $this->Requisicao->Equipamento->find('list');
        foreach ($equipamentos as $id => $nome) {
            $dados['Equipamentos'][$nome] = $this->Requisicao->find('count', array('conditions' => array('equipamento_id' => $id)));
            $array_chart['Equipamentos'][$id - 1][0] = $nome;
            $array_chart['Equipamentos'][$id - 1][1] = $dados['Equipamentos'][$nome];
        }

        $situacoes = $this->Requisicao->Situacao->find('list');
        foreach ($situacoes as $id => $nome) {
            $dados['Situacoes'][$nome] = $this->Requisicao->find('count', array('conditions' => array('situacao_id' => $id)));
            $array_chart['Situacoes'][$id][0] = $nome;
            $array_chart['Situacoes'][$id][1] = $dados['Situacoes'][$nome];
        }

        $grupos = $this->Requisicao->Requisitante->Grupo->find('list');
        foreach ($grupos as $id => $nome) {
            $dados['Grupos'][$nome] = $this->Requisicao->find('count', array('conditions' => array('Requisitante.grupo_id' => $id)));
            $array_chart['Grupos'][$id - 1][0] = $nome;
            $array_chart['Grupos'][$id - 1][1] = $dados['Grupos'][$nome];
        }

        $this->chart('Situação das Requisições', 'pie', $array_chart['Situacoes'], 'situacao_chart', 'Número de Requisições');
        $this->chart('Requisitantes', 'pie', $array_chart['Grupos'], 'requisitante_chart', 'Número de Requisições');
        $this->chart('Equipamentos', 'pie', $array_chart['Equipamentos'], 'equipamento_chart', 'Número de Requisições');

        $this->set(compact('dados'));
    }

    function chart($nome, $tipo, $dados, $divID, $coluna) {
        $chart = $this->HighCharts->create($nome, $tipo);

        $this->HighCharts->setChartParams(
                $nome, array(
            'renderTo' => $divID,
            'chartMarginTop' => 60,
            'chartAlignTicks' => FALSE,
            'chartBackgroundColorLinearGradient' => array(0, 0, 0, 300),
            'chartBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
            'title' => $nome,
            'titleAlign' => 'center',
            'titleFloating' => TRUE,
            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
            'titleStyleColor' => '#0099ff',
            'titleY' => 20,
//            'legendEnabled' => TRUE,
//            'legendLayout' => 'horizontal',
//            'legendAlign' => 'center',
//            'legendVerticalAlign ' => 'bottom',
//            'legendItemStyle' => array('color' => '#222'),
//            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
//            'legendBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
//            'tooltipEnabled' => TRUE,
//            'tooltipBackgroundColorLinearGradient' => array(0, 0, 0, 50), // triggers js error
//            'tooltipBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)'))
                )
        );

        $series = $this->HighCharts->addChartSeries();

        $series->addName($coluna)->addData($dados);

        $chart->addSeries($series);
    }

}
