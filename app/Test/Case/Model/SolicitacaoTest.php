<?php

App::uses('Solicitacao', 'Model');

/**
 * Solicitacao Test Case
 *
 */
class SolicitacaoTest extends CakeTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.solicitacao',
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
        $this->Solicitacao = ClassRegistry::init('Solicitacao');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown() {
        unset($this->Solicitacao);

        parent::tearDown();
    }

}
