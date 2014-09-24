<?php

/**
 * RequisicaoFixture
 *
 */
class RequisicaoFixture extends CakeTestFixture {

    /**
     * Fields
     *
     * @var array
     */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
        'requisitante_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'departamento_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
        'fuel' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 15, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
            'requisitante_id' => 1,
            'departamento_id' => 1,
            'fuel' => 'Lorem ipsum d',
            'sala' => 'Lorem ipsum dolor ',
            'equipamento' => 'Lorem ipsum dolor sit amet',
            'descricao' => 'Lorem ipsum dolor sit amet',
            'tecnico_id' => 1,
            'situacao' => 1
        ),
    );

}
