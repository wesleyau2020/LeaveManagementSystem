<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php
$this->assign('title', __('User'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Users', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title">User Details</h2>
    <?= $this->Html->link(__('Sign Out'), ['action' => 'logout'], ['class' => 'btn btn-default'], ['style' => 'float: right;']) ?>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
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
            <th><?= __('Hospital Leave (HL)') ?></th>
            <td><?= $this->Number->format($user->num_hospital_leave) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit Details'), ['action' => 'edit', $user->id], ['class' => 'btn btn-secondary']) ?>
    </div>
  </div>
</div>


<div class="related related-leaveDetails view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Leave Details') ?></h3>
    <div class="card-toolbox">
      <!-- <?= $this->Html->link(__('New'), ['controller' => 'LeaveDetails' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'LeaveDetails' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?> -->
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Carried Over') ?></th>
          <th><?= __('Max Carry Over') ?></th>
          <th><?= __('Num AL Given') ?></th>
          <th><?= __('Num ML Given') ?></th>
          <th><?= __('Num HL Given') ?></th>
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
        <?php endforeach; ?>
      <?php } ?>
    </table>

    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Num AL Left') ?></th>
          <th><?= __('Num ML Left') ?></th>
          <th><?= __('Num HL Left') ?></th>
      </tr>
      <?php if (empty($user->leave_details)) { ?>
        <tr>
            <td colspan="12" class="text-muted">
              Leave Details record not found!
            </td>
        </tr>
      <?php } else{ ?>
        <?php foreach ($user->leave_details as $leaveDetails) : ?>
        <tr>
            <td><?= h($leaveDetails->num_AL_left) ?></td>
            <td><?= h($leaveDetails->num_ML_left) ?></td>
            <td><?= h($leaveDetails->num_HL_left) ?></td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>
</div>

