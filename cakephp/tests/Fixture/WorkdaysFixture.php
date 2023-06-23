<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WorkdaysFixture
 */
class WorkdaysFixture extends TestFixture
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
                'day_of_week' => 'Lorem ip',
                'is_workday' => 1,
            ],
        ];
        parent::init();
    }
}
