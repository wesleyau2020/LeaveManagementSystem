<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveType $leaveType
 */
?>

<?php
$this->assign('title', __('Leave Type'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Types', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($leaveType->name) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
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
            <td><?= $this->Number->format($leaveType->leave_type_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Cost') ?></th>
            <td><?= $this->Number->format($leaveType->cost) ?></td>
        </tr>
        <tr>
            <th><?= __('Entitled') ?></th>
            <td><?= $this->Number->format($leaveType->entitled) ?></td>
        </tr>
        <tr>
            <th><?= __('Earned') ?></th>
            <td><?= $this->Number->format($leaveType->earned) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $leaveType->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $leaveType->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveType->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-leaveTypes view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Leave Types') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'LeaveTypes' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'LeaveTypes' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
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
      <?php if (empty($leaveType->leave_types)) { ?>
        <tr>
            <td colspan="8" class="text-muted">
              Leave Types record not found!
            </td>
        </tr>
      <?php }else{ ?>
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
              <?= $this->Html->link(__('View'), ['controller' => 'LeaveTypes', 'action' => 'view', $leaveTypes->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveTypes', 'action' => 'edit', $leaveTypes->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveTypes', 'action' => 'delete', $leaveTypes->id], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $leaveTypes->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
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
          <th><?= __('Leave Type Id') ?></th>
          <th><?= __('Year') ?></th>
          <th><?= __('Max Carry Over') ?></th>
          <th><?= __('Carried Over') ?></th>
          <th><?= __('Entitled') ?></th>
          <th><?= __('Balance') ?></th>
          <th><?= __('Earned') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($leaveType->leave_details)) { ?>
        <tr>
            <td colspan="10" class="text-muted">
              Leave Details record not found!
            </td>
        </tr>
      <?php }else{ ?>
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
      <?php if (empty($leaveType->leave_requests)) { ?>
        <tr>
            <td colspan="11" class="text-muted">
              Leave Requests record not found!
            </td>
        </tr>
      <?php }else{ ?>
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

