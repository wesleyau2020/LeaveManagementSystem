<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

 /** @var string input_year */
 $input_year = $_POST["input_year"]??date('Y');
?>

<!-- Nav Bar -->
<?php
$this->assign('title', __('User'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Users', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<!-- User Details -->
<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h3 class="card-title" style="float: left;">User Details</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('ID') ?></th>
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
            <th><?= __('Hospital Leave (HL)') ?></th>
            <td><?= $this->Number->format($user->num_hospital_leave) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Logout'), ['action' => 'logout'], ['class' => 'btn btn-default'],) ?>
    </div>
  </div>
</div>

<!-- Leave Details (Year) -->
<div style="margin-top: 40px" class="related related-leaveDetails view card" >
  <div class="card-header d-sm-flex" >
    <h3 class="card-title">Leave Details (Year)</h3>

    <div class="card-toolbox">
      <!-- <?= $this->Html->link(__('New'), ['controller' => 'LeaveDetails' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'LeaveDetails' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?> -->
    </div>
  </div>

    <!-- Leave Days Given -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
      <?php echo "<th>Leave Days Given ({$input_year})</th>" ?>
        <tr>
            <th><?= __('Carried Over') ?></th>
            <th><?= __('Max Carry Over') ?></th>
            <th><?= __('Annual Leave (AL)') ?></th>
            <th><?= __('Medical Leave (ML)') ?></th>
            <th><?= __('Hospital Leave (HL)') ?></th>
            <!-- <th class="actions"><?= __('Actions') ?></th> -->
        </tr>
        <?php if (empty($user->leave_details)) { ?>
          <tr>
              <td colspan="12" class="text-muted">
                Leave Details record not found!
              </td>
          </tr>
        <?php } else{ ?>
          <?php foreach ($user->leave_details as $leaveDetails) : ?>
            <?php if ($leaveDetails->year === $input_year): ?>
          <tr>
              <td><?= h($leaveDetails->carried_over) ?></td>
              <td><?= h($leaveDetails->max_carry_over) ?></td>
              <td><?= h($leaveDetails->num_AL_given) ?></td>
              <td><?= h($leaveDetails->num_ML_given) ?></td>
              <td><?= h($leaveDetails->num_HL_given) ?></td>
              <!-- <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'LeaveDetails', 'action' => 'view', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveDetails', 'action' => 'edit', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveDetails', 'action' => 'delete', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $leaveDetails->id)]) ?>
              </td> -->
          </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php } ?>
      </table>

      <!-- Leave Balance -->
      <table class="table table-hover text-nowrap">
      <?php echo "<th>Leave Balance ({$input_year})</th>" ?>
        <tr>
            <th><?= __('Annual Leave (AL)') ?></th>
            <th><?= __('Medical Leave (ML)') ?></th>
            <th><?= __('Hospital Leave (HL)') ?></th>
        </tr>
        <?php if (empty($user->leave_details)) { ?>
          <tr>
              <td colspan="12" class="text-muted">
                Leave Details record not found!
              </td>
          </tr>
        <?php } else{ ?>
          <?php foreach ($user->leave_details as $leaveDetails) : ?>
            <?php if ($leaveDetails->year === $input_year): ?>
              <tr>
                  <td><?= h($leaveDetails->num_AL_left) ?></td>
                  <td><?= h($leaveDetails->num_ML_left) ?></td>
                  <td><?= h($leaveDetails->num_HL_left) ?></td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php } ?>
      </table>

    <div class="ml-auto">
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
            'default' => $input_year,
            'style' => 'width:15%'
        ])
    ?>
    <?php
        echo $this->Form->button('Submit');
        echo $this->Form->end();
    ?>
    </div>
  </div>
</div>

