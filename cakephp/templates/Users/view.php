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
    <h2 class="card-title"><?= h($user->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
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
            <td><?= $this->Number->format($user->admin_level) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Admin') ?></th>
            <td><?= $user->is_admin ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $user->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-leaveDetails view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Leave Details') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'LeaveDetails' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'LeaveDetails' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
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
      <?php if (empty($user->leave_details)) { ?>
        <tr>
            <td colspan="12" class="text-muted">
              Leave Details record not found!
            </td>
        </tr>
      <?php }else{ ?>
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
              <?= $this->Html->link(__('View'), ['controller' => 'LeaveDetails', 'action' => 'view', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveDetails', 'action' => 'edit', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveDetails', 'action' => 'delete', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $leaveDetails->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

<div class="related related-leaveRequests view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Leave Requests') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'LeaveRequests' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'LeaveRequests' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
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
      <?php if (empty($user->leave_requests)) { ?>
        <tr>
            <td colspan="11" class="text-muted">
              Leave Requests record not found!
            </td>
        </tr>
      <?php }else{ ?>
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
              <?= $this->Html->link(__('View'), ['controller' => 'LeaveRequests', 'action' => 'view', $leaveRequests->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveRequests', 'action' => 'edit', $leaveRequests->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveRequests', 'action' => 'delete', $leaveRequests->id], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $leaveRequests->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

