<?php

App::uses('Requisicao', 'Model');

/**
 * Requisicao Test Case
 *
 */
class RequisicaoTest extends CakeTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.requisicao',
        'app.requisitante',
        'app.departamento',
        'app.tecnico'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->Requisicao = ClassRegistry::init('Requisicao');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown() {
        unset($this->Requisicao);

        parent::tearDown();
    }

}
