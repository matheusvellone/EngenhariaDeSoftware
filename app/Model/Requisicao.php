<?php

App::uses('AppModel', 'Model');

/**
 * Requisicao Model
 *
 * @property Requisitante $Requisitante
 * @property Departamento $Departamento
 * @property Equipamento $Equipamento
 * @property Tecnico $Tecnico
 */
class Requisicao extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'requisitante_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'departamento_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
//        'fuel' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
        'sala' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'equipamento_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'descricao' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'tecnico_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'situacao_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Requisitante' => array(
            'className' => 'Usuario',
            'foreignKey' => 'requisitante_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Departamento' => array(
            'className' => 'Departamento',
            'foreignKey' => 'departamento_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Equipamento' => array(
            'className' => 'Equipamento',
            'foreignKey' => 'equipamento_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Tecnico' => array(
            'className' => 'Usuario',
            'foreignKey' => 'tecnico_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Situacao' => array(
            'className' => 'Situacao',
            'foreignKey' => 'situacao_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

}
