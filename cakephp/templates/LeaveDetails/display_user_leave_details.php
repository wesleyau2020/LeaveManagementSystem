<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

/** @var string inputYear */
$inputYear = $_POST["inputYear"]??date('Y');
?>

<?php
$this->assign('title', __('Leave Details'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'Display Leave Details']
]);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
  <div style="padding-top:7px">
      <?php $title = ($user->username).'\'s Leave Details ('.$inputYear .')'?>
      <h3 class="card-title"><?= __("").$title?></h3>
  </div>
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
</div>