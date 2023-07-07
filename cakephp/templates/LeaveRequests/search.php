<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest $leaveRequest
 */
?>
<?php
$this->assign('title', __('Search Leave Request'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests', 'url' => ['action' => 'index']],
    ['title' => 'Search'],
]);
?>

<div class="card card-primary card-outline">
  <div class="card-body">
    <?= $this->Form->create($leaveRequest, ['url' => ['controller' => 'LeaveRequests', 'action' => 'search'], 'type' => 'get']) ?>
    <!-- <?= $this->Form->control('<variable name>', ['label' => '<input field>']) ?> -->
    <?= $this->Form->control('userID', ['label' => 'User ID', 'required' => true,]) ?>
    <?= $this->Form->control('leaveTypeID', ['label' => 'Leave Type ID', 'required' => true,]) ?>
    <?= $this->Form->control('start_of_leave', ['label' => 'Start Date']) ?>
    <?= $this->Form->control('end_of_leave', ['label' => 'End Date']) ?>
    <?= $this->Form->control('year', ['label' => 'Year']) ?>
    <?= $this->Form->control('status', [
      'label' => 'Status',
      'options' => [
        'Approved' => 'Approved',
        'Rejected' => 'Rejected',
        'Awaiting Level 2' => 'Awaiting Level 2',
        'Awaiting Level 1' => 'Awaiting Level 1',
      ],
      'required' => true,
      ]) ?>
    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Form->end() ?>
  </div>
</div>

