<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
//        'DebugKit.Toolbar',
        'Auth' => array(
            'loginAction' => array('controller' => 'Usuarios', 'action' => 'login'),
            'loginRedirect' => array('controller' => 'Portal', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'Usuarios', 'action' => 'login'),
            'authError' => 'Faça login para utilizar o sistema. Ou crie um novo cadastro para acessar o sistema',
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array(
                        'usuario' => 'username',
                        'senha' => 'password'
                    )
                )
            ),
            'flash' => array(
                'element' => 'Flash/custom',
                'key' => 'auth',
                'params' => array('class' => 'flash_info')
            )
        ),
        'Session'
    );
    public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter() {
        if ($this->Auth->user()) {
            $this->set('usuarioLogado', $this->Auth->user());
        }
    }

    public function setFlash($message, $class) {
        $this->Session->setFlash($message, 'Flash/custom', compact('class'));
    }

}
