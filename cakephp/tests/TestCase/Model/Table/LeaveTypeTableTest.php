<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveTypeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveTypeTable Test Case
 */
class LeaveTypeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveTypeTable
     */
    protected $LeaveType;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LeaveType',
        'app.LeaveRequests',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('LeaveType') ? [] : ['className' => LeaveTypeTable::class];
        $this->LeaveType = $this->getTableLocator()->get('LeaveType', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LeaveType);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LeaveTypeTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LeaveTypeTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
