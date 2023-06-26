<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CalendarTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CalendarTable Test Case
 */
class CalendarTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CalendarTable
     */
    protected $Calendar;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Calendar',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Calendar') ? [] : ['className' => CalendarTable::class];
        $this->Calendar = $this->getTableLocator()->get('Calendar', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Calendar);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CalendarTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
