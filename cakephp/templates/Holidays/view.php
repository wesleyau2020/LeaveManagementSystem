<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Holiday $holiday
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Holiday'), ['action' => 'edit', $holiday->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Holiday'), ['action' => 'delete', $holiday->id], ['confirm' => __('Are you sure you want to delete # {0}?', $holiday->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Holidays'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Holiday'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="holidays view content">
            <h3><?= h($holiday->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($holiday->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($holiday->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= h($holiday->start_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td><?= h($holiday->end_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Holiday') ?></th>
                    <td><?= $holiday->is_holiday ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
