<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CalendarFixture
 */
class CalendarFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'calendar';
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
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'start_date' => '2023-06-26',
                'end_date' => '2023-06-26',
            ],
        ];
        parent::init();
    }
}
