<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Holiday $holiday
 */
?>

<?php
use benhall14\phpCalendar\Calendar as Calendar;

$this->assign('title', __('Holiday'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Holidays', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <?php 
    // Add button here
    ?>
  </div>
  <div class="card-body table-responsive p-0">
    <?php
    $calendar = new Calendar;
    $calendar->stylesheet();
    
    foreach ($holidays as $holiday) {
        $start_date = $holiday->date->format('Y-m-d');
        $end_date = $start_date;
        $calendar->addEvent(
            $start_date, # start date in Y-m-d 
            $end_date, # end date in Y-m-d
            $holiday->description, # event name text
            true, # should the date be masked - boolean default true
        );
    }

    $calendar->addEvent(
        '2023-06-01',   
        '2023-06-01',   
        'Test Event',  
        true,           
    );
    
    $calendar->display();
    ?>
  </div>
  <div class="card-footer d-flex">
    <div class="">
    </div>
    <div class="ml-auto">
    </div>
  </div>
</div>