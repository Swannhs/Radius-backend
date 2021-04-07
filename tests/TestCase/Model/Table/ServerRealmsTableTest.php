<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServerRealmsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServerRealmsTable Test Case
 */
class ServerRealmsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ServerRealmsTable
     */
    public $ServerRealms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ServerRealms',
        'app.Servers',
        'app.Realms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ServerRealms') ? [] : ['className' => ServerRealmsTable::class];
        $this->ServerRealms = TableRegistry::getTableLocator()->get('ServerRealms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ServerRealms);

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
