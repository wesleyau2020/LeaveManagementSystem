<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Holiday> $holidays
 */
?>
<div class="holidays index content">
    <?= $this->Html->link(__('New Holiday'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Holidays') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('start_date') ?></th>
                    <th><?= $this->Paginator->sort('end_date') ?></th>
                    <th><?= $this->Paginator->sort('is_holiday') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($holidays as $holiday): ?>
                <tr>
                    <td><?= $this->Number->format($holiday->id) ?></td>
                    <td><?= h($holiday->start_date) ?></td>
                    <td><?= h($holiday->end_date) ?></td>
                    <td><?= h($holiday->is_holiday) ?></td>
                    <td><?= h($holiday->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $holiday->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $holiday->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $holiday->id], ['confirm' => __('Are you sure you want to delete # {0}?', $holiday->id)]) ?>
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
