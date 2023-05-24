<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\LeaveDetail> $leaveDetails
 */
?>
<div class="leaveDetails index content">
    <?= $this->Html->link(__('New Leave Detail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Leave Details') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('year') ?></th>
                    <th><?= $this->Paginator->sort('carried_over') ?></th>
                    <th><?= $this->Paginator->sort('max_carry_over') ?></th>
                    <th><?= $this->Paginator->sort('AL_given') ?></th>
                    <th><?= $this->Paginator->sort('AL_left') ?></th>
                    <th><?= $this->Paginator->sort('ML_given') ?></th>
                    <th><?= $this->Paginator->sort('ML_left') ?></th>
                    <th><?= $this->Paginator->sort('HL_given') ?></th>
                    <th><?= $this->Paginator->sort('HL_left') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaveDetails as $leaveDetail): ?>
                <tr>
                    <td><?= $this->Number->format($leaveDetail->id) ?></td>
                    <td><?= $leaveDetail->has('user') ? $this->Html->link($leaveDetail->user->id, ['controller' => 'Users', 'action' => 'view', $leaveDetail->user->id]) : '' ?></td>
                    <td><?= h($leaveDetail->year) ?></td>
                    <td><?= $this->Number->format($leaveDetail->carried_over) ?></td>
                    <td><?= $this->Number->format($leaveDetail->max_carry_over) ?></td>
                    <td><?= $this->Number->format($leaveDetail->num_AL_given) ?></td>
                    <td><?= $this->Number->format($leaveDetail->num_AL_left) ?></td>
                    <td><?= $this->Number->format($leaveDetail->num_ML_given) ?></td>
                    <td><?= $this->Number->format($leaveDetail->num_ML_left) ?></td>
                    <td><?= $this->Number->format($leaveDetail->num_HL_given) ?></td>
                    <td><?= $this->Number->format($leaveDetail->num_HL_left) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $leaveDetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveDetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveDetail->id)]) ?>
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
