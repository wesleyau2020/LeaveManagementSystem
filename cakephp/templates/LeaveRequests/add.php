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
    //   echo $this->Form->control('leave_type');
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

