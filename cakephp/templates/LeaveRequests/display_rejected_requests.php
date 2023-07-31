<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest[]|\Cake\Collection\CollectionInterface $leaveRequests
 */

/** @var string inputYear */
$inputYear = $_POST["inputYear"]??date('Y');
?>

<?php
$this->assign('title', __('Rejected Requests'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'Display Rejected Requests'],
]);
?>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
      <h2 class="card-title" style="margin-top:10px"><?= __('Rejected Requests')?></h2>
      <div class="card-toolbox">
        <!-- select year via dropdown menu -->
        <div style="float:left;">
        <?= 
            $this->Form->create(null, [
                'type' => 'post',
                'valueSources' => ['query', 'data'],
                'url' => ['action' => 'displayRejectedRequests/'],
            ])
        ?>
        <?=
            $this->Form->year('inputYear', [
                'min' => 2000,
                'max' => date('Y'),
                'default' => $inputYear
            ])
        ?>
      </div>
      <div style="float:right">
        <?php
            echo $this->Form->button('Submit');
            echo $this->Form->end();
        ?>
      </div>
      </div>
    </div>
    <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
          <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('leave_start') ?></th>
                    <th><?= $this->Paginator->sort('leave_end') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('remark') ?></th>
                </tr>
          </thead>
          <tbody>
            <?php foreach ($rejectedLeaveRequests as $leaveRequest) : ?>
              <?php if ($leaveRequest->year === $inputYear): ?>
                  <tr>
                    <td><?= $this->Number->format($leaveRequest->id) ?></td>
                    <td><?= h($leaveRequest->user->username) ?></td>
                    <td><?= h($leaveRequest->description) ?></td>
                    <td><?= $this->Number->format($leaveRequest->days) ?></td>
                    <td><?= h($leaveRequest->leave_type->name) ?></td>
                    <td><?= h($leaveRequest->start_of_leave) ?></td>
                    <td><?= h($leaveRequest->end_of_leave) ?></td>
                    <td><?= h($leaveRequest->status) ?></td>
                    <td><?= h($leaveRequest->remark) ?></td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
          </tbody>
      </table>
  </div>
  <div class="card-footer d-flex">
    <div class="ml-auto">
      <div>
        <!-- Toggle button to switch between active/inactive users -->
        <?= $this->Form->create(null, ['url' => ['controller' => 'leaveRequests', 'action' => '/displayRejectedRequests']]); ?>
        <?= $this->Html->link(__('Display Approved Requests'), ['action' => 'displayApprovedRequests'], ['class' => 'btn btn-outline-primary btn-sm']) ?>
        <?= $this->Html->link(__('Add New Request'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title" style="margin-top:10px"><?= __('Pending Requests')?></h2>
        <div class="card-toolbox"></div>
    </div>
    <!-- /.card-header -->
    
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('leave_start') ?></th>
                    <th><?= $this->Paginator->sort('leave_end') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('remark') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingLeaveRequests as $leaveRequest) : ?>
                    <?php if ($leaveRequest->year === $inputYear): ?>
                    <tr>
                        <td><?= $this->Number->format($leaveRequest->id) ?></td>
                        <td><?= h($leaveRequest->user->username) ?></td>
                        <td><?= h($leaveRequest->description) ?></td>
                        <td><?= $this->Number->format($leaveRequest->days) ?></td>
                        <td><?= h($leaveRequest->leave_type->name) ?></td>
                        <td><?= h($leaveRequest->start_of_leave) ?></td>
                        <td><?= h($leaveRequest->end_of_leave) ?></td>
                        <td><?= h($leaveRequest->status) ?></td>
                        <td><?= h($leaveRequest->remark) ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
