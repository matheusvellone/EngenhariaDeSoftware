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
                $this->Session->setFlash('Número de Matrícula e/ou Chapa Funcional ' . $username . ' não encontrado', 'flash/custom', array('class' => 'flash_info'));
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
                    $cake_email->send();

                    return $this->redirect(array('controller' => 'Usuarios', 'action' => 'login'));
                } else {
                    $this->Session->setFlash('A nova senha não pode ser gerada. Por favor, tente novamente.', 'flash/custom', array('class' => 'flash_error'));
                }
            } else {
                $this->Session->setFlash('O email da conta ' . $username . ' (' . $email . ') está inválido. Entre em contado com algum técnico.', 'flash/custom', array('class' => 'flash_error'));
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
            $this->Session->setFlash('ID ' . $id . ' inexistente', 'flash/custom', array('class' => 'flash_error'));
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
            $this->Session->setFlash('ID ' . $id . ' inexistente. Tente realizar o login novamente.', 'flash/custom', array('class' => 'flash_error'));
            throw new NotFoundException;
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->request->data['Usuario']['grupo_id'] == 1 && $this->Auth->user('grupo_id') != 1) {
                $this->Session->setFlash('Não foi possível efetuar a edição pois você nao tem permissão para ser um Técnico', 'flash/custom', array('class' => 'flash_info'));
                return;
            }
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
//    public function delete($id = null) {
//        $this->Usuario->id = $id;
//        if (!$this->Usuario->exists()) {
//            throw new NotFoundException('Invalid usuario');
//        }
//        $this->request->allowMethod('post', 'delete');
//        if ($this->Usuario->delete()) {
//            $this->Session->setFlash('O usuário foi deletado com sucesso', 'flash/custom', array('class' => 'flash_info'));
//        } else {
//            $this->Session->setFlash('O usuário não pode ser deletado', 'flash/custom', array('class' => 'flash_error'));
//        }
//        return $this->redirect(array('action' => 'index'));
//    }

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
        if($this->request->is('post', 'put')) {
            $this->request->data['Usuario']['id'] = $this->Auth->user('id');
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash('A senha foi alterada com sucesso.', 'flash/custom', array('class' => 'flash_success'));
                return $this->redirect(array('controller' => 'Usuarios', 'action' => 'login'));
            } else {
                $this->Session->setFlash('A senha não pode ser alterada', 'flash/custom', array('class' => 'flash_error'));
                return;
            }
        }
    }

}
