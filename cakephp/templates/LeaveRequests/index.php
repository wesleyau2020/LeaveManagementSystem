<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\LeaveRequest> $leaveRequests
 */
?>
<div class="leaveRequests index content">
    <?= $this->Html->link(__('New Leave Request'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Leave Requests') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('leave_type') ?></th>
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
                <?php foreach ($leaveRequests as $leaveRequest): ?>
                <tr>
                    <td><?= $this->Number->format($leaveRequest->id) ?></td>
                    <td><?= $leaveRequest->has('user') ? $this->Html->link($leaveRequest->user->id, ['controller' => 'Users', 'action' => 'view', $leaveRequest->user->id]) : '' ?></td>
                    <td><?= h($leaveRequest->leave_type) ?></td>
                    <td><?= h($leaveRequest->start_of_leave) ?></td>
                    <td><?= h($leaveRequest->end_of_leave) ?></td>
                    <td><?= $this->Number->format($leaveRequest->num_days) ?></td>
                    <td><?= h($leaveRequest->year) ?></td>
                    <td><?= h($leaveRequest->description) ?></td>
                    <td><?= h($leaveRequest->status) ?></td>
                    <td><?= h($leaveRequest->remark) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $leaveRequest->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveRequest->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveRequest->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
