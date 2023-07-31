<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

/** @var string inputYear */
$inputYear = $_POST["inputYear"]??date('Y');
?>

<?php
$this->assign('title', __('Welcome '.$user->username.'!'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Users', 'url' => ['action' => 'index']],
    ['title' => 'View'],
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('User Details')?></h3>
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
            <th><?= __('Start Date') ?></th>
            <td><?= h($user->start_date) ?></td>
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


<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Leave Details (').$inputYear .')'?></h3>
    <div class="card-toolbox">  
      <div class="ml-auto">
          <!-- select year via dropdown menu -->
          <div style="float: left">
            <?= 
                $this->Form->create(null, [
                    'type' => 'post',
                    'valueSources' => ['query', 'data'],
                    'url' => ['action' => 'view/'.($user->id)],
                    'style' => "margin-right: 5px"
                ])
            ?>
            <?=
                $this->Form->year('inputYear', [
                    'min' => 2000,
                    'max' => date('Y'),
                    'default' => $inputYear,
                ])
            ?>
          </div>
          <?php
              echo $this->Form->button('Submit');
              echo $this->Form->end();
          ?>
      </div>
    </div>
  </div>
  
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id') ?></th>
          <th><?= __('Leave Type') ?></th>
          <th><?= __('Carried Over') ?></th>
          <th><?= __('Max Carry Over') ?></th>
          <th><?= __('Entitled') ?></th>
          <th><?= __('Balance') ?></th>
          <th><?= __('Earned') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($user->leave_details)) { ?>
        <tr>
            <td colspan="10" class="text-muted">
              Leave Details record not found!
            </td>
        </tr>
      <?php } else { ?>
        <?php foreach ($user->leave_details as $leaveDetails) : ?>
          <?php if ($leaveDetails->year === $inputYear) : ?>
            <?php $leaveTypeName = $leaveTypeNames[$leaveDetails->leave_type_id - 1]; ?>
              <tr>
                <td><?= h($leaveDetails->id) ?></td>
                <td><?= h($leaveTypeName) ?></td>
                <td><?= h($leaveDetails->carried_over) ?></td>
                <td><?= h($leaveDetails->max_carry_over) ?></td>
                <td><?= h($leaveDetails->entitled) ?></td>
                <td><?= h($leaveDetails->balance) ?></td>
                <td><?= h($leaveDetails->earned) ?></td>
                <td class="actions">
                  <?= $this->Html->link(__('View'), ['controller' => 'LeaveDetails', 'action' => 'view', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
                  <?= $this->Html->link(__('Edit'), ['controller' => 'LeaveDetails', 'action' => 'edit', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-primary']) ?>
                  <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeaveDetails', 'action' => 'delete', $leaveDetails->id], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $leaveDetails->id)]) ?>
              </td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <!--  -->
    </div>
</div>