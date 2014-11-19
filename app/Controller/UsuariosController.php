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
        $this->Auth->allow('login', 'add', 'logout', 'esqueci_senha');
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
        if ($this->Auth->user('grupo_id') != 1) {
            return $this->redirect(array('controller' => 'Portal', 'action' => 'index'));
        }
        $this->Usuario->recursive = 0;
        $this->set('usuarios', $this->Paginator->paginate());
    }

    public function esqueci_senha() {
        if ($this->request->is('post', 'put')) {
            $username = $this->request->data['Usuario']['username'];
            $this->Usuario->recursive = 0;
            $usuario = $this->Usuario->find('first', array(
                'conditions' => array(
                    'username' => $username
                )
            ));
            if ($usuario == null) {
                $this->setFlash('Número de Matrícula e/ou Chapa Funcional ' . $username . ' não encontrado', 'flash_info');
                return;
            }
            $email = $usuario['Usuario']['email'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $senha = $this->geraSenha();
                $usuario['Usuario']['password'] = $senha;
                if ($this->Usuario->save($usuario)) {
                    App::uses('CakeEmail', 'Network/Email');
                    $cake_email = new CakeEmail('gmail');
                    $cake_email->emailFormat('html');
                    $cake_email->to($email);
                    $cake_email->template('nova_senha', 'default');
                    $cake_email->subject('NOVA SENHA - SUPORTE CCE UEL');

                    $cake_email->viewVars(array('senha' => $senha));
                    try {
                        $cake_email->send();
                    } catch (Exception $ex) {
                        $this->setFlash('O email com a nova senha não pode ser enviado('.$ex->getMessage().'). Tente novamente', 'flash_info');
                        return $this->redirect(array('action' => 'esqueci_senha'));
                    }

                    return $this->redirect(array('controller' => 'Usuarios', 'action' => 'login'));
                } else {
                    $this->setFlash('A nova senha não pode ser gerada. Por favor, tente novamente.', 'flash_error');
                }
            } else {
                $this->setFlash('O email da conta ' . $username . ' (' . $email . ') está inválido. Entre em contado com algum técnico.', 'flash_error');
                return;
            }
        }
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
            $this->setFlash('ID ' . $id . ' inexistente', 'flash_error');
            throw new NotFoundException;
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
                $this->setFlash('Você não tem permissão para criar um cadastro de Técnicos', 'flash_info');
                $grupos = $this->Usuario->Grupo->find('list');
                $this->set(compact('grupos'));
                return;
            }
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->setFlash('O usuário foi salvo com sucesso', 'flash_success');
                return $this->redirect(array('action' => 'login'));
            } else {
                $this->setFlash('Não foi possível efetuar o cadastro. Por favor confirme se não existem erros no cadastro', 'flash_error');
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
        $options = array('conditions' => array('Usuario.' . $this->Usuario->primaryKey => $id));
        $usuario = $this->Usuario->find('first', $options);
        if (!$this->Usuario->exists($id)) {
            $this->setFlash('Tente fazer o login novamente.', 'flash_error');
            throw new NotFoundException;
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Usuario']['grupo_id'] = $usuario['Usuario']['grupo_id'];
            if ($this->request->data['Usuario']['grupo_id'] == 1 && $this->Auth->user('grupo_id') != 1) {
                $this->setFlash('Não foi possível efetuar a edição pois você nao tem permissão para ser um Técnico', 'flash_info');
                return;
            }
            if ($this->Usuario->save($this->request->data)) {
                $this->setFlash('O usuário foi editado com sucesso', 'flash_success');
                return $this->redirect(array('controller' => 'Portal', 'action' => 'index'));
            } else {
                $this->setFlash('O usuário não pode ser editado', 'flash_error');
            }
        } else {
            $this->request->data = $usuario;
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
//    public function delete($id = null) {
//        $this->Usuario->id = $id;
//        if (!$this->Usuario->exists()) {
//            throw new NotFoundException('Invalid usuario');
//        }
//        $this->request->allowMethod('post', 'delete');
//        if ($this->Usuario->delete()) {
//            $this->setFlash('O usuário foi deletado com sucesso', 'flash_info');
//        } else {
//            $this->setFlash('O usuário não pode ser deletado', 'flash_error');
//        }
//        return $this->redirect(array('action' => 'index'));
//    }

    public function login() {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->loginRedirect);
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->setFlash('Login efetuado com sucesso', 'flash_success');
                return $this->redirect($this->Auth->redirect());
            }
            $this->setFlash('Usuário ou Senha incorreto', 'flash_error');
        }
    }

    public function logout() {
        $this->setFlash('Logout efetuado com sucesso', 'flash_info');
        $this->redirect($this->Auth->logout());
    }

    public function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';

        $caracteres .= $lmin;
        if ($maiusculas) {
            $caracteres .= $lmai;
        }
        if ($numeros) {
            $caracteres .= $num;
        }
        if ($simbolos) {
            $caracteres .= $simb;
        }

        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

    public function alterarSenha() {
        if ($this->request->is('post', 'put')) {
            $this->request->data['Usuario']['id'] = $this->Auth->user('id');
            if ($this->Usuario->save($this->request->data)) {
                $this->setFlash('A senha foi alterada com sucesso.', 'flash_success');
                return $this->redirect(array('controller' => 'Usuarios', 'action' => 'login'));
            } else {
                $this->setFlash('A senha não pode ser alterada', 'flash_error');
                return;
            }
        }
    }

}
