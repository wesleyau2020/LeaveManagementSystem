<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveType $leaveType
 */
?>
<?php
$this->assign('title', __('Add Leave Type'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Types', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($leaveType) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('name');
      echo $this->Form->control('type');
      echo $this->Form->control('leave_type_id');
      echo $this->Form->control('cost');
      echo $this->Form->control('entitled');
      echo $this->Form->control('earned');
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

