<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LeaveTypesFixture
 */
class LeaveTypesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor ',
                'type' => 'Lorem ip',
                'leave_type_id' => 1,
                'cost' => 1,
                'entitled' => 1,
                'earned' => 1,
            ],
        ];
        parent::init();
    }
}
