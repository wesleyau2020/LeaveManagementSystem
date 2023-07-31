<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveDetail $leaveDetail
 */
?>

<?php
$this->assign('title', __('Leave Detail'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Details', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title" style="padding-top:5px"><?= h($leaveDetail->id) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
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
            <th><?= __('Leave Type Id') ?></th>
            <td><?= $this->Number->format($leaveDetail->leave_type_id) ?></td>
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
            <th><?= __('Entitled') ?></th>
            <td><?= $this->Number->format($leaveDetail->entitled) ?></td>
        </tr>
        <tr>
            <th><?= __('Balance') ?></th>
            <td><?= $this->Number->format($leaveDetail->balance) ?></td>
        </tr>
        <tr>
            <th><?= __('Earned') ?></th>
            <td><?= $this->Number->format($leaveDetail->earned) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $leaveDetail->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $leaveDetail->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveDetail->id], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>
</div>
