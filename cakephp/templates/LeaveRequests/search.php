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
    <?= $this->Form->control('userID', ['label' => 'User ID']) ?>
    <?= $this->Form->control('leaveTypeID', ['label' => 'Leave Type ID']) ?>
    <?= $this->Form->control('start_of_leave', ['label' => 'Start Date', 'required' => false]) ?>
    <?= $this->Form->control('end_of_leave', ['label' => 'End Date', 'required' => false]) ?>
    <?= $this->Form->control('year', ['label' => 'Year']) ?>
    <?= $this->Form->control('status', [
      'label' => 'Status',
      'options' => [
        'Approved' => 'Approved',
        'Rejected' => 'Rejected',
        'Awaiting Level 2' => 'Awaiting Level 2',
        'Awaiting Level 1' => 'Awaiting Level 1',
      ],
      // 'required' => true,
      ]) ?>
    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Form->end() ?>
  </div>
</div>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title" style="margin-top:10px">
          <?= __('Search Results: ')?>
        </h2>
        <div class="card-toolbox">
          <!--  -->
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('leave_type_id') ?></th>
                    <th><?= $this->Paginator->sort('start_of_leave') ?></th>
                    <th><?= $this->Paginator->sort('end_of_leave') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('year') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('remark') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaveRequestsContains as $leaveRequest) : ?>
                    <tr>
                        <td><?= $this->Number->format($leaveRequest->id) ?></td>
                        <td><?= $leaveRequest->has('user') ? $this->Html->link($leaveRequest->user->id, ['controller' => 'Users', 'action' => 'view', $leaveRequest->user->id]) : '' ?></td>
                        <td><?= $leaveRequest->has('leave_type') ? $this->Html->link($leaveRequest->leave_type->name, ['controller' => 'LeaveTypes', 'action' => 'view', $leaveRequest->leave_type->id]) : '' ?></td>
                        <td><?= h($leaveRequest->start_of_leave) ?></td>
                        <td><?= h($leaveRequest->end_of_leave) ?></td>
                        <td><?= $this->Number->format($leaveRequest->days) ?></td>
                        <td><?= h($leaveRequest->year) ?></td>
                        <td><?= h($leaveRequest->description) ?></td>
                        <td><?= h($leaveRequest->status) ?></td>
                        <td><?= h($leaveRequest->remark) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $leaveRequest->id)]) ?>
                        </td>
                    </tr>
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
