<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TemposMediosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TemposMediosTable Test Case
 */
class TemposMediosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TemposMediosTable
     */
    public $TemposMedios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TemposMedios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TemposMedios') ? [] : ['className' => TemposMediosTable::class];
        $this->TemposMedios = TableRegistry::getTableLocator()->get('TemposMedios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TemposMedios);

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
}
