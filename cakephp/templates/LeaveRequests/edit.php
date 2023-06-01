<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest $leaveRequest
 */
?>
<?php
$this->assign('title', __('Edit Leave Request'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $leaveRequest->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($leaveRequest) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('leave_type');
      echo $this->Form->control('start_of_leave');
      echo $this->Form->control('end_of_leave');
      echo $this->Form->control('year');
      echo $this->Form->control('description');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $leaveRequest->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $leaveRequest->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

