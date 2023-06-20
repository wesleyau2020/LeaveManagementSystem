<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest[]|\Cake\Collection\CollectionInterface $leaveRequests
 */

/** @var string input_year */
$input_year = $_POST["input_year"]??date('Y');
?>

<?php
$this->assign('title', __('Leave List: '));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests'],
]);
?>

<div>

</div>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title">
            <!-- -->
        </h2>
        <div class="card-toolbox">
            <div style="margin-right:645px">
                <?= $this->Html->link(__('New Leave Request'), ['action' => 'add'], ['class' => 'btn btn-primary btn-m']) ?>
            </div>

            <!-- select year via dropdown menu -->
            <div style="float:left">
                <?= 
                    $this->Form->create($leaveRequests, [
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
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('leave_type') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('start_of_leave') ?></th>
                    <th><?= $this->Paginator->sort('end_of_leave') ?></th>
                    <th><?= $this->Paginator->sort('remark') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaveRequests as $leaveRequest) : ?>
                    <?php if ($leaveRequest->year === $input_year): ?>
                    <tr>
                        <td><?= $this->Number->format($leaveRequest->id) ?></td>
                        <td><?= h($leaveRequest->description) ?></td>
                        <td><?= h($leaveRequest->status) ?></td>
                        <td><?= h($leaveRequest->leave_type->name) ?></td>
                        <td><?= $this->Number->format($leaveRequest->days) ?></td>
                        <td><?= h($leaveRequest->start_of_leave) ?></td>
                        <td><?= h($leaveRequest->end_of_leave) ?></td>
                        <td><?= h($leaveRequest->remark) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $leaveRequest->id)]) ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer d-md-flex paginator">
        <div class="mr-auto" style="font-size:.8rem">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
        <ul class="pagination pagination-sm">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
    </div>
    <!-- /.card-footer -->
</div>
