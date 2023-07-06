<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$toggleActive = $_POST["toggleApproved"]??true;
?>
<?php
$this->assign('title', __('Approved requests'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List LeaveRequests', 'url' => ['action' => 'index']],
    ['title' => 'Display Approved Requests'],
]);
?>

<div class="card card-primary card-outline">
  <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
          <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('leave_type') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('start_of_leave') ?></th>
                    <th><?= $this->Paginator->sort('end_of_leave') ?></th>
                    <th><?= $this->Paginator->sort('remark') ?></th>
                </tr>
          </thead>
          <tbody>
          <?php foreach ($approvedLeaveRequests as $leaveRequest) : ?>
                <tr>
                    <td><?= $this->Number->format($leaveRequest->id) ?></td>
                    <td><?= h($leaveRequest->description) ?></td>
                    <td><?= h($leaveRequest->status) ?></td>
                    <td><?= h($leaveRequest->leave_type->name) ?></td>
                    <td><?= $this->Number->format($leaveRequest->days) ?></td>
                    <td><?= h($leaveRequest->start_of_leave) ?></td>
                    <td><?= h($leaveRequest->end_of_leave) ?></td>
                    <td><?= h($leaveRequest->remark) ?></td>
                </tr>
                <?php endforeach; ?>
          </tbody>
      </table>
  </div>
  <div class="card-footer d-flex">
    <div class="ml-auto">
      <div>
        <!-- Toggle button to switch between active/inactive users -->
        <?= $this->Form->create(null, ['url' => ['controller' => 'leaveRequests', 'action' => '/displayRejectedRequests']]); ?>
        <?= $this->Html->link(__('Display Rejected Requests'), ['action' => 'displayRejectedRequests'], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>