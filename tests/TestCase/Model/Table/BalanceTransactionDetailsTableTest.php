<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BalanceTransactionDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BalanceTransactionDetailsTable Test Case
 */
class BalanceTransactionDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BalanceTransactionDetailsTable
     */
    public $BalanceTransactionDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BalanceTransactionDetails',
        'app.ReceiverUsers',
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
        $config = TableRegistry::getTableLocator()->exists('BalanceTransactionDetails') ? [] : ['className' => BalanceTransactionDetailsTable::class];
        $this->BalanceTransactionDetails = TableRegistry::getTableLocator()->get('BalanceTransactionDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BalanceTransactionDetails);

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
