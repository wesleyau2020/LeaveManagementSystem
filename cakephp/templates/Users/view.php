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
            <?= $this->Html->link(__('Edit Details'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->username) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Annual Leave (AL)') ?></th>
                    <td><?= $this->Number->format($user->num_annual_leave) ?></td>
                </tr>
                <tr>
                    <th><?= __('Medical Leave (ML)') ?></th>
                    <td><?= $this->Number->format($user->num_medical_leave) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hospital Leave (ML)') ?></th>
                    <td><?= $this->Number->format($user->num_hospital_leave) ?></td>
                </tr>
            </table>

            <div class="related">
                <h3><?= __('Leave Details') ?></h3>
                <?php if (!empty($user->leave_details)) : ?>
                <div class="table-responsive">
                    <table>                            
                        <th>Leave Days Given</th>
                        <tr>
                            <th><?= __('Year') ?></th>
                            <th><?= __('Carried Over') ?></th>
                            <th><?= __('Max Carry Over') ?></th>
                            <th><?= __('Annual Leave (AL)') ?></th>
                            <th><?= __('Annual Leave (MC)') ?></th>
                            <th><?= __('Annual Leave (HL)') ?></th>
                        </tr>
                        <?php foreach ($user->leave_details as $leaveDetails) : ?>
                        <tr>
                            <td><?= h($leaveDetails->year) ?></td>
                            <td><?= h($leaveDetails->carried_over) ?></td>
                            <td><?= h($leaveDetails->max_carry_over) ?></td>
                            <td><?= h($leaveDetails->num_AL_given) ?></td>
                            <td><?= h($leaveDetails->num_ML_given) ?></td>
                            <td><?= h($leaveDetails->num_HL_given) ?></td>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="table-responsive">
                    <table>
                        <th>Leave Balance</th>
                        <tr>
                            <th><?= __('Annual Leave (AL)') ?></th>
                            <th><?= __('Annual Leave (MC)') ?></th>
                            <th><?= __('Annual Leave (HL)') ?></th>
                        </tr>
                        <?php foreach ($user->leave_details as $leaveDetails) : ?>
                        <tr>
                            <td><?= h($leaveDetails->num_AL_left) ?></td>
                            <td><?= h($leaveDetails->num_ML_left) ?></td>
                            <td><?= h($leaveDetails->num_HL_left) ?></td>
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
