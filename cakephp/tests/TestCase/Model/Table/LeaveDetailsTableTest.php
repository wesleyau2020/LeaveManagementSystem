<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveDetailsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveDetailsTable Test Case
 */
class LeaveDetailsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveDetailsTable
     */
    protected $LeaveDetails;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LeaveDetails',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('LeaveDetails') ? [] : ['className' => LeaveDetailsTable::class];
        $this->LeaveDetails = $this->getTableLocator()->get('LeaveDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LeaveDetails);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LeaveDetailsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LeaveDetailsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
