<?php

App::uses('AppModel', 'Model');

/**
 * Situacao Model
 *
 * @property Requisicao $Requisicao
 */
class Situacao extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'situacao';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Requisicao' => array(
            'className' => 'Requisicao',
            'foreignKey' => 'situacao_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
