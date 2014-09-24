<?php

App::uses('Departamento', 'Model');

/**
 * Departamento Test Case
 *
 */
class DepartamentoTest extends CakeTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.departamento',
        'app.requisicao',
        'app.user',
        'app.group',
        'app.post'
    );

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->Departamento = ClassRegistry::init('Departamento');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown() {
        unset($this->Departamento);

        parent::tearDown();
    }

}
