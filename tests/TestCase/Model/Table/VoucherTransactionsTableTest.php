<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VoucherTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VoucherTransactionsTable Test Case
 */
class VoucherTransactionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VoucherTransactionsTable
     */
    public $VoucherTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.VoucherTransactions',
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
        $config = TableRegistry::getTableLocator()->exists('VoucherTransactions') ? [] : ['className' => VoucherTransactionsTable::class];
        $this->VoucherTransactions = TableRegistry::getTableLocator()->get('VoucherTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VoucherTransactions);

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
