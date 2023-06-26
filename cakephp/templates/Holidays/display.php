<?php
// require 'vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;

$calendar = new Calendar;
$calendar->stylesheet();

# if needed, add event
$calendar->addEvent(
    '2023-06-14',   # start date in either Y-m-d or Y-m-d H:i if you want to add a time.
    '2023-06-14',   # end date in either Y-m-d or Y-m-d H:i if you want to add a time.
    'My Birthday',  # event name text
    true,           # should the date be masked - boolean default true
);

$calendar->display();
?>