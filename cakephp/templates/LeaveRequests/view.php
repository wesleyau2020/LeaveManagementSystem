<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest $leaveRequest
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Leave Request'), ['action' => 'edit', $leaveRequest->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Leave Request'), ['action' => 'delete', $leaveRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveRequest->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Leave Requests'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Leave Request'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leaveRequests view content">
            <h3><?= h($leaveRequest->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $leaveRequest->has('user') ? $this->Html->link($leaveRequest->user->id, ['controller' => 'Users', 'action' => 'view', $leaveRequest->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Leave Type') ?></th>
                    <td><?= h($leaveRequest->leave_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Year') ?></th>
                    <td><?= h($leaveRequest->year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($leaveRequest->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($leaveRequest->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Remark') ?></th>
                    <td><?= h($leaveRequest->remark) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($leaveRequest->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num Days') ?></th>
                    <td><?= $this->Number->format($leaveRequest->num_days) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Of Leave') ?></th>
                    <td><?= h($leaveRequest->start_of_leave) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Of Leave') ?></th>
                    <td><?= h($leaveRequest->end_of_leave) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
