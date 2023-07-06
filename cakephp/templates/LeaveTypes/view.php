<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveType $leaveType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Leave Type'), ['action' => 'edit', $leaveType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Leave Type'), ['action' => 'delete', $leaveType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Leave Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Leave Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leaveTypes view content">
            <h3><?= h($leaveType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($leaveType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($leaveType->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($leaveType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Leave Type Id') ?></th>
                    <td><?= $leaveType->leave_type_id === null ? '' : $this->Number->format($leaveType->leave_type_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cost') ?></th>
                    <td><?= $this->Number->format($leaveType->cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('Entitled') ?></th>
                    <td><?= $leaveType->entitled === null ? '' : $this->Number->format($leaveType->entitled) ?></td>
                </tr>
                <tr>
                    <th><?= __('Earned') ?></th>
                    <td><?= $leaveType->earned === null ? '' : $this->Number->format($leaveType->earned) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Leave Types') ?></h4>
                <?php if (!empty($leaveType->leave_types)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Leave Type Id') ?></th>
                            <th><?= __('Cost') ?></th>
                            <th><?= __('Entitled') ?></th>
                            <th><?= __('Earned') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($leaveType->leave_types as $leaveTypes) : ?>
                        <tr>
                            <td><?= h($leaveTypes->id) ?></td>
                            <td><?= h($leaveTypes->name) ?></td>
                            <td><?= h($leaveTypes->type) ?></td>
                            <td><?= h($leaveTypes->leave_type_id) ?></td>
                            <td><?= h($leaveTypes->cost) ?></td>
                            <td><?= h($leaveTypes->entitled) ?></td>
                            <td><?= h($leaveTypes->earned) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'LeaveTypes', 'action' => 'view', $leaveTypes->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveTypes', 'action' => 'edit', $leaveTypes->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveTypes', 'action' => 'delete', $leaveTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveTypes->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Leave Details') ?></h4>
                <?php if (!empty($leaveType->leave_details)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Leave Type Id') ?></th>
                            <th><?= __('Year') ?></th>
                            <th><?= __('Max Carry Over') ?></th>
                            <th><?= __('Carried Over') ?></th>
                            <th><?= __('Entitled') ?></th>
                            <th><?= __('Balance') ?></th>
                            <th><?= __('Earned') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($leaveType->leave_details as $leaveDetails) : ?>
                        <tr>
                            <td><?= h($leaveDetails->id) ?></td>
                            <td><?= h($leaveDetails->user_id) ?></td>
                            <td><?= h($leaveDetails->leave_type_id) ?></td>
                            <td><?= h($leaveDetails->year) ?></td>
                            <td><?= h($leaveDetails->max_carry_over) ?></td>
                            <td><?= h($leaveDetails->carried_over) ?></td>
                            <td><?= h($leaveDetails->entitled) ?></td>
                            <td><?= h($leaveDetails->balance) ?></td>
                            <td><?= h($leaveDetails->earned) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'LeaveDetails', 'action' => 'view', $leaveDetails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveDetails', 'action' => 'edit', $leaveDetails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveDetails', 'action' => 'delete', $leaveDetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveDetails->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Leave Requests') ?></h4>
                <?php if (!empty($leaveType->leave_requests)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Leave Type Id') ?></th>
                            <th><?= __('Start Of Leave') ?></th>
                            <th><?= __('End Of Leave') ?></th>
                            <th><?= __('Days') ?></th>
                            <th><?= __('Year') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Remark') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($leaveType->leave_requests as $leaveRequests) : ?>
                        <tr>
                            <td><?= h($leaveRequests->id) ?></td>
                            <td><?= h($leaveRequests->user_id) ?></td>
                            <td><?= h($leaveRequests->leave_type_id) ?></td>
                            <td><?= h($leaveRequests->start_of_leave) ?></td>
                            <td><?= h($leaveRequests->end_of_leave) ?></td>
                            <td><?= h($leaveRequests->days) ?></td>
                            <td><?= h($leaveRequests->year) ?></td>
                            <td><?= h($leaveRequests->description) ?></td>
                            <td><?= h($leaveRequests->status) ?></td>
                            <td><?= h($leaveRequests->remark) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'LeaveRequests', 'action' => 'view', $leaveRequests->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveRequests', 'action' => 'edit', $leaveRequests->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveRequests', 'action' => 'delete', $leaveRequests->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveRequests->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
