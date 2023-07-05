<?php
// require 'vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;

$calendar = new Calendar;
$calendar->stylesheet();

foreach ($holidays as $holiday) {
    $startDate = $holiday->start_date->format('Y-m-d');
    $endDate = $holiday->end_date->format('Y-m-d');
    $calendar->addEvent(
        $startDate,             # start date in either Y-m-d or Y-m-d H:i if you want to add a time.
        $endDate,               # end date in either Y-m-d or Y-m-d H:i if you want to add a time.
        $holiday->description,  # event name text
        true,                   # should the date be masked - boolean default true
    );
}

$calendar->display();
?>