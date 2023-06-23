<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workday $workday
 */
?>
<?php
$this->assign('title', __('Add Workday'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Workdays', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($workday) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('day_of_week');
      echo $this->Form->control('is_workday', ['custom' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

