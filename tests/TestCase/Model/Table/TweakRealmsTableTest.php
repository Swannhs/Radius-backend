<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TweakRealmsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TweakRealmsTable Test Case
 */
class TweakRealmsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TweakRealmsTable
     */
    public $TweakRealms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TweakRealms',
        'app.Tweaks',
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
        $config = TableRegistry::getTableLocator()->exists('TweakRealms') ? [] : ['className' => TweakRealmsTable::class];
        $this->TweakRealms = TableRegistry::getTableLocator()->get('TweakRealms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TweakRealms);

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
