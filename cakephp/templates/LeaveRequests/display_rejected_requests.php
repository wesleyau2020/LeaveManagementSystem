<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$toggleActive = $_POST["toggleApproved"]??true;
?>
<?php
$this->assign('title', __('Rejected requests'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests', 'url' => ['action' => 'index']],
    ['title' => 'Display Rejected Requests'],
]);
?>

<div class="card card-primary card-outline">
  <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
          <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('leave_start') ?></th>
                    <th><?= $this->Paginator->sort('leave_end') ?></th>
                    <th><?= $this->Paginator->sort('remark') ?></th>
                </tr>
          </thead>
          <tbody>
            <?php foreach ($rejectedLeaveRequests as $leaveRequest) : ?>
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
        <?= $this->Form->create(null, ['url' => ['controller' => 'leaveRequests', 'action' => '/displayApprovedRequests']]); ?>
        <?= $this->Html->link(__('Display Approved Requests'), ['action' => 'displayApprovedRequests'], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>