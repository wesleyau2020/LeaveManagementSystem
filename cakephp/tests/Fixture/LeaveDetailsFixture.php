<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LeaveDetailsFixture
 */
class LeaveDetailsFixture extends TestFixture
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
                'leave_type_id' => 1,
                'year' => 'Lorem ipsum dolor sit amet',
                'carried_over' => 1,
                'max_carry_over' => 1,
                'entitled' => 1,
                'balance' => 1,
                'earned' => 1,
            ],
        ];
        parent::init();
    }
}
