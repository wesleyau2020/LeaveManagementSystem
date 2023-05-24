<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveDetail $leaveDetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Leave Detail'), ['action' => 'edit', $leaveDetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Leave Detail'), ['action' => 'delete', $leaveDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveDetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Leave Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Leave Detail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leaveDetails view content">
            <h3><?= h($leaveDetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $leaveDetail->has('user') ? $this->Html->link($leaveDetail->user->id, ['controller' => 'Users', 'action' => 'view', $leaveDetail->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Year') ?></th>
                    <td><?= h($leaveDetail->year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($leaveDetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Carried Over') ?></th>
                    <td><?= $this->Number->format($leaveDetail->carried_over) ?></td>
                </tr>
                <tr>
                    <th><?= __('Max Carry Over') ?></th>
                    <td><?= $this->Number->format($leaveDetail->max_carry_over) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num AL Given') ?></th>
                    <td><?= $this->Number->format($leaveDetail->num_AL_given) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num AL Left') ?></th>
                    <td><?= $this->Number->format($leaveDetail->num_AL_left) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num ML Given') ?></th>
                    <td><?= $this->Number->format($leaveDetail->num_ML_given) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num ML Left') ?></th>
                    <td><?= $this->Number->format($leaveDetail->num_ML_left) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num HL Given') ?></th>
                    <td><?= $this->Number->format($leaveDetail->num_HL_given) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num HL Left') ?></th>
                    <td><?= $this->Number->format($leaveDetail->num_HL_left) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
