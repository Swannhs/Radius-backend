<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TweaksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TweaksTable Test Case
 */
class TweaksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TweaksTable
     */
    public $Tweaks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Tweaks') ? [] : ['className' => TweaksTable::class];
        $this->Tweaks = TableRegistry::getTableLocator()->get('Tweaks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tweaks);

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
