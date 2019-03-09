<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormasPagamentosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormasPagamentosTable Test Case
 */
class FormasPagamentosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormasPagamentosTable
     */
    public $FormasPagamentos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.FormasPagamentos',
        'app.Empresas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FormasPagamentos') ? [] : ['className' => FormasPagamentosTable::class];
        $this->FormasPagamentos = TableRegistry::getTableLocator()->get('FormasPagamentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormasPagamentos);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
