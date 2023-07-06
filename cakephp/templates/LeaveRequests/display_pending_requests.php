<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest[]|\Cake\Collection\CollectionInterface $leaveRequests
 */

/** @var string input_year */
$input_year = $_POST["input_year"]??date('Y');
?>

<?php
$this->assign('title', __('Pending requests'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests', 'url' => ['action' => 'index']],
    ['title' => 'Display Pending Requests'],
]);
?>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title">
            <!-- -->
        </h2>
        <div class="card-toolbox">
            <!-- select year via dropdown menu -->
            <div style="float:left;">
                <?= 
                    $this->Form->create($pendingLeaveRequests, [
                        'type' => 'post',
                        'valueSources' => ['query', 'data'],
                        'url' => ['action' => 'index/'],
                    ])
                ?>
                <?=
                    $this->Form->year('input_year', [
                        'min' => 2000,
                        'max' => date('Y'),
                        'default' => $input_year
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
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('leave_start') ?></th>
                    <th><?= $this->Paginator->sort('leave_end') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('remark') ?></th>
                    <th class="actions"><?= __('Approve') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingLeaveRequests as $leaveRequest) : ?>
                    <?php if ($leaveRequest->year === $input_year): ?>
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
                        <td class="actions">
                            <?= $this->Html->link(__('Approve'), ['action' => 'approve', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Reject'), ['action' => 'reject', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false]) ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
