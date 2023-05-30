<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num Annual Leave') ?></th>
                    <td><?= $this->Number->format($user->num_annual_leave) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num Medical Leave') ?></th>
                    <td><?= $this->Number->format($user->num_medical_leave) ?></td>
                </tr>
                <tr>
                    <th><?= __('Num Hospital Leave') ?></th>
                    <td><?= $this->Number->format($user->num_hospital_leave) ?></td>
                </tr>
                <tr>
                    <th><?= __('Admin Level') ?></th>
                    <td><?= $user->admin_level === null ? '' : $this->Number->format($user->admin_level) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Admin') ?></th>
                    <td><?= $user->is_admin ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Leave Details') ?></h4>
                <?php if (!empty($user->leave_details)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Year') ?></th>
                            <th><?= __('Carried Over') ?></th>
                            <th><?= __('Max Carry Over') ?></th>
                            <th><?= __('Num AL Given') ?></th>
                            <th><?= __('Num AL Left') ?></th>
                            <th><?= __('Num ML Given') ?></th>
                            <th><?= __('Num ML Left') ?></th>
                            <th><?= __('Num HL Given') ?></th>
                            <th><?= __('Num HL Left') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->leave_details as $leaveDetails) : ?>
                        <tr>
                            <td><?= h($leaveDetails->id) ?></td>
                            <td><?= h($leaveDetails->user_id) ?></td>
                            <td><?= h($leaveDetails->year) ?></td>
                            <td><?= h($leaveDetails->carried_over) ?></td>
                            <td><?= h($leaveDetails->max_carry_over) ?></td>
                            <td><?= h($leaveDetails->num_AL_given) ?></td>
                            <td><?= h($leaveDetails->num_AL_left) ?></td>
                            <td><?= h($leaveDetails->num_ML_given) ?></td>
                            <td><?= h($leaveDetails->num_ML_left) ?></td>
                            <td><?= h($leaveDetails->num_HL_given) ?></td>
                            <td><?= h($leaveDetails->num_HL_left) ?></td>
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
                <?php if (!empty($user->leave_requests)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Leave Type') ?></th>
                            <th><?= __('Start Of Leave') ?></th>
                            <th><?= __('End Of Leave') ?></th>
                            <th><?= __('Num Days') ?></th>
                            <th><?= __('Year') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Remark') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->leave_requests as $leaveRequests) : ?>
                        <tr>
                            <td><?= h($leaveRequests->id) ?></td>
                            <td><?= h($leaveRequests->user_id) ?></td>
                            <td><?= h($leaveRequests->leave_type) ?></td>
                            <td><?= h($leaveRequests->start_of_leave) ?></td>
                            <td><?= h($leaveRequests->end_of_leave) ?></td>
                            <td><?= h($leaveRequests->num_days) ?></td>
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
