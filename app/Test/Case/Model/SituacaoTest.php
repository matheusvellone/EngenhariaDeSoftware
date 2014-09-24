<?php

App::uses('Situacao', 'Model');

/**
 * Situacao Test Case
 *
 */
class SituacaoTest extends CakeTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.situacao',
        'app.requisicao',
        'app.usuario',
        'app.grupo',
        'app.departamento',
        'app.equipamento'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->Situacao = ClassRegistry::init('Situacao');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown() {
        unset($this->Situacao);

        parent::tearDown();
    }

}
