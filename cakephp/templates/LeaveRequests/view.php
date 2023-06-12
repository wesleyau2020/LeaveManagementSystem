<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest $leaveRequest
 */
?>

<?php
$this->assign('title', __('Leave Request'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($leaveRequest->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $leaveRequest->has('user') ? $this->Html->link($leaveRequest->user->id, ['controller' => 'Users', 'action' => 'view', $leaveRequest->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Leave Type') ?></th>
            <td><?= h($leaveRequest->leave_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Year') ?></th>
            <td><?= h($leaveRequest->year) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($leaveRequest->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($leaveRequest->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Remark') ?></th>
            <td><?= h($leaveRequest->remark) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($leaveRequest->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Num Days') ?></th>
            <td><?= $this->Number->format($leaveRequest->num_days) ?></td>
        </tr>
        <tr>
            <th><?= __('Start Of Leave') ?></th>
            <td><?= h($leaveRequest->start_of_leave) ?></td>
        </tr>
        <tr>
            <th><?= __('End Of Leave') ?></th>
            <td><?= h($leaveRequest->end_of_leave) ?></td>
        </tr>
    </table>
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
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveRequest->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


