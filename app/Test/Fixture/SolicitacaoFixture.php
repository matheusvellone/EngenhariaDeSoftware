<?php

/**
 * SolicitacaoFixture
 *
 */
class SolicitacaoFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'departamento_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'sala' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'equipamento' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'descricao' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
        'tecnico_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'situacao' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
    );

    /**
     * Records
     *
     * @var array
     */
    public $records = array(
        array(
            'id' => 1,
            'departamento_id' => 1,
            'sala' => 'Lorem ipsum dolor ',
            'equipamento' => 'Lorem ipsum dolor sit amet',
            'descricao' => 'Lorem ipsum dolor sit amet',
            'tecnico_id' => 1,
            'situacao' => 1
        ),
    );

}
