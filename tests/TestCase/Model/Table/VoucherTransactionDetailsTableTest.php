<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VoucherTransactionDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VoucherTransactionDetailsTable Test Case
 */
class VoucherTransactionDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VoucherTransactionDetailsTable
     */
    public $VoucherTransactionDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.VoucherTransactionDetails',
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
        $config = TableRegistry::getTableLocator()->exists('VoucherTransactionDetails') ? [] : ['className' => VoucherTransactionDetailsTable::class];
        $this->VoucherTransactionDetails = TableRegistry::getTableLocator()->get('VoucherTransactionDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VoucherTransactionDetails);

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
