<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'start_date' => '2023-06-28',
                'end_date' => '2023-06-28',
                'is_admin' => 1,
                'admin_level' => 1,
                'is_active' => 1,
            ],
        ];
        parent::init();
    }
}
