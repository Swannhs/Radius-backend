<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BalanceSenderDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BalanceSenderDetailsTable Test Case
 */
class BalanceSenderDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BalanceSenderDetailsTable
     */
    public $BalanceSenderDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BalanceSenderDetails',
        'app.SenderUsers',
        'app.Users',
        'app.Realms',
        'app.Profiles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BalanceSenderDetails') ? [] : ['className' => BalanceSenderDetailsTable::class];
        $this->BalanceSenderDetails = TableRegistry::getTableLocator()->get('BalanceSenderDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BalanceSenderDetails);

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
