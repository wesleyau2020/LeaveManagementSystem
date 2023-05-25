<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

/** @var string input_year */
$input_year = $_POST["input_year"]??date('Y');
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
            <!-- display username and sign out button-->
            <!-- <h3 style="float:left;"><?= h($user->username)?></h3> -->
            <h3 style="float:left;"><?=  __('User Details:') ?></h3>
            <div style="float:right;">
            <?= $this->Html->link("Sign Out", ['action' => 'logout']) ?>
            </div>

            <!-- display user details -->
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

            <h3 style="margin-top:50px;"><?= __('Leave Details (Year):') ?></h3>

            <!-- select year via dropdown menu -->
            <?= 
                $this->Form->create($user, [
                    'type' => 'post',
                    'valueSources' => ['query', 'data'],
                    'url' => ['action' => 'view/'.($user->id)]
                 ])
            ?>
            <?=
                $this->Form->year('input_year', [
                    'min' => 2000,
                    'max' => date('Y'),
                    'default' => date('Y'),
                    'style' => 'width:20%'
                ]);
            ?>
            <?php
                echo $this->Form->button('Submit');
                echo $this->Form->end();
            ?>

            <!-- display leave details-->
            <div class="related">
                <?php if (!empty($user->leave_details)) : ?>
                <div class="table-responsive">
                    <table>
                        <?php echo "<th>Leave Days Given ({$input_year})</th>" ?>
                        <tr>
                            <th><?= __('Carried Over') ?></th>
                            <th><?= __('Max Carry Over') ?></th>
                            <th><?= __('Annual Leave (AL)') ?></th>
                            <th><?= __('Annual Leave (MC)') ?></th>
                            <th><?= __('Annual Leave (HL)') ?></th>
                        </tr>
                        <?php foreach ($user->leave_details as $leaveDetails) : ?>
                            <?php if ($leaveDetails->year === $input_year): ?>
                                <tr>
                                    <td><?= h($leaveDetails->carried_over) ?></td>
                                    <td><?= h($leaveDetails->max_carry_over) ?></td>
                                    <td><?= h($leaveDetails->num_AL_given) ?></td>
                                    <td><?= h($leaveDetails->num_ML_given) ?></td>
                                    <td><?= h($leaveDetails->num_HL_given) ?></td>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="table-responsive" style="margin-top:20px;">
                    <table>
                        <?php echo "<th>Leave Balance ({$input_year})</th>" ?>
                        <tr>
                            <th><?= __('Annual Leave (AL)') ?></th>
                            <th><?= __('Annual Leave (MC)') ?></th>
                            <th><?= __('Annual Leave (HL)') ?></th>
                        </tr>
                        <?php foreach ($user->leave_details as $leaveDetails) : ?>
                            <?php if ($leaveDetails->year === $input_year): ?>
                            <tr>
                                <td><?= h($leaveDetails->num_AL_left) ?></td>
                                <td><?= h($leaveDetails->num_ML_left) ?></td>
                                <td><?= h($leaveDetails->num_HL_left) ?></td>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
