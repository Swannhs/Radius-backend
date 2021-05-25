<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AmountComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AmountComponent Test Case
 */
class AmountComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\AmountComponent
     */
    public $Amount;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Amount = new AmountComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Amount);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
