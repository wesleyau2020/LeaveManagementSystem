<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest $leaveRequest
 */
?>
<?php
$this->assign('title', __('Request Leave: '));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
<!-- This will POST the form data to the add() action of ArticlesController.  -->
  <?= $this->Form->create($leaveRequest) ?> 
  <div class="card-body">
    <?php

    ?>
    <?php
      $options=[
      'Annual Leave (AL)'=>'Annual Leave (AL)',
      'Urgent Leave (UL)'=>'Urgent Leave (UL)', 
      'Earned Leave (EL)'=>'Earned Leave (EL)', 
      'Half Day (AM)'=>'Half Day (AM)', 
      'Half Day (PM)'=>'Half Day (PM)', 
      'Medical Leave (MC)'=>'Medical Leave (MC)', 
      'Hospital Leave (HL)'=>'Hospital Leave (HL)'];

      echo $this->Form->control('leave_type', ['options' => $options]);
      echo $this->Form->control('start_of_leave');
      echo $this->Form->control('end_of_leave');
      echo $this->Form->control('year');
      echo $this->Form->control('description');
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

