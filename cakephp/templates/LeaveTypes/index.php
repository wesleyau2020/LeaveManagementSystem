<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\LeaveType> $leaveTypes
 */
?>
<div class="leaveTypes index content">
    <?= $this->Html->link(__('New Leave Type'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Leave Types') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('leave_type_id') ?></th>
                    <th><?= $this->Paginator->sort('cost') ?></th>
                    <th><?= $this->Paginator->sort('entitled') ?></th>
                    <th><?= $this->Paginator->sort('earned') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaveTypes as $leaveType): ?>
                <tr>
                    <td><?= $this->Number->format($leaveType->id) ?></td>
                    <td><?= h($leaveType->name) ?></td>
                    <td><?= h($leaveType->type) ?></td>
                    <td><?= $leaveType->leave_type_id === null ? '' : $this->Number->format($leaveType->leave_type_id) ?></td>
                    <td><?= $this->Number->format($leaveType->cost) ?></td>
                    <td><?= $leaveType->entitled === null ? '' : $this->Number->format($leaveType->entitled) ?></td>
                    <td><?= $leaveType->earned === null ? '' : $this->Number->format($leaveType->earned) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $leaveType->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveType->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveType->id)]) ?>
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
