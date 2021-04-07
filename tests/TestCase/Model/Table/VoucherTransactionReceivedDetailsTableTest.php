<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VoucherTransactionReceivedDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VoucherTransactionReceivedDetailsTable Test Case
 */
class VoucherTransactionReceivedDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VoucherTransactionReceivedDetailsTable
     */
    public $VoucherTransactionReceivedDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.VoucherTransactionReceivedDetails',
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
        $config = TableRegistry::getTableLocator()->exists('VoucherTransactionReceivedDetails') ? [] : ['className' => VoucherTransactionReceivedDetailsTable::class];
        $this->VoucherTransactionReceivedDetails = TableRegistry::getTableLocator()->get('VoucherTransactionReceivedDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VoucherTransactionReceivedDetails);

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
