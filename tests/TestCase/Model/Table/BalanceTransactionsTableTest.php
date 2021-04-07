<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BalanceTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BalanceTransactionsTable Test Case
 */
class BalanceTransactionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BalanceTransactionsTable
     */
    public $BalanceTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BalanceTransactions',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BalanceTransactions') ? [] : ['className' => BalanceTransactionsTable::class];
        $this->BalanceTransactions = TableRegistry::getTableLocator()->get('BalanceTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BalanceTransactions);

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
