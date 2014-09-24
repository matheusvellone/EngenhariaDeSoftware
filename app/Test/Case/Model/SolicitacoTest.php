<?php

App::uses('Solicitaco', 'Model');

/**
 * Solicitaco Test Case
 *
 */
class SolicitacoTest extends CakeTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = array(
        'app.solicitaco',
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
        $this->Solicitaco = ClassRegistry::init('Solicitaco');
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown() {
        unset($this->Solicitaco);

        parent::tearDown();
    }

}
