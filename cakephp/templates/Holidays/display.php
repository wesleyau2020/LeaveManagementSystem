<?php use benhall14\phpCalendar\Calendar as Calendar; ?>

<?php
$this->assign('title', __('Holidays'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Holidays', 'url' => ['action' => 'index']],
    ['title' => 'Display'],
]);
?>

<div class="card card-primary card-outline">
  <div class="card-body">
    <?php
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
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Html->link(__('Add Holiday'), ['controller' => 'Holidays', 'action' => 'add'], ['class' => 'btn btn-default']);?>
    </div>
  </div>
</div>