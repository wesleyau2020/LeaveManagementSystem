<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LeaveRequestsFixture
 */
class LeaveRequestsFixture extends TestFixture
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
                'user_id' => 1,
                'leave_type' => 'Lo',
                'start_of_leave' => '2023-05-22',
                'end_of_leave' => '2023-05-22',
                'num_days' => 1,
                'year' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ip',
                'remark' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
