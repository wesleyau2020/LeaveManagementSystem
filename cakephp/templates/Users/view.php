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

<!-- Leave Details (Year) -->
<div style="margin-top: 40px" class="related related-leaveDetails view card" >
  <div class="card-header d-sm-flex" >
    <h3 class="card-title">Leave Details (Year)</h3>
  </div>

    <!-- Leave Days Given -->
    <div class="card-body table-responsive p-0">
      <table style="margin-top: 20px" class="table table-hover text-nowrap">
        <?php echo "<th>Leave Days Given ({$input_year})</th>" ?>
        <tr>
            <th><?= __('Carried Over') ?></th>
            <th><?= __('Max Carry Over') ?></th>
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
          <?php
              foreach ($user->leave_details as $leaveDetails) {
                if ($leaveDetails->year === $input_year) {
                  if ($leaveDetails->leave_type_id === 1) {
                    $AL_entitled = $leaveDetails->entitled;
                    $AL_balance = $leaveDetails->balance;
                  } elseif ($leaveDetails->leave_type_id === 2) {
                    $ML_entitled = $leaveDetails->entitled;
                    $ML_balance = $leaveDetails->balance;
                  } elseif ($leaveDetails->leave_type_id === 3) {
                    $HL_entitled = $leaveDetails->entitled;
                    $HL_balance = $leaveDetails->balance;
                  }
                }
              }
          ?>

          <td><?= h($leaveDetails->carried_over) ?></td>
          <td><?= h($leaveDetails->max_carry_over) ?></td>
          <td><?= h($AL_entitled) ?></td>
          <td><?= h($ML_entitled) ?></td>
          <td><?= h($HL_entitled) ?></td>
        <?php } ?>
      </table>

      <!-- Leave Balance -->
      <table style="margin-top: 20px" class="table table-hover text-nowrap">
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
          <tr>
              <td><?= h($AL_balance) ?></td>
              <td><?= h($ML_balance) ?></td>
              <td><?= h($HL_balance) ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

    <div class="card-footer d-flex">
      <div class="">
      </div>
    <div class="ml-auto">
        <!-- select year via dropdown menu -->
        <div style="float: left">
        <?= 
            $this->Form->create($user, [
                'type' => 'post',
                'valueSources' => ['query', 'data'],
                'url' => ['action' => 'view/'.($user->id)],
                'style' => "margin-right: 5px"
            ])
        ?>
        <?=
            $this->Form->year('input_year', [
                'min' => 2000,
                'max' => date('Y'),
                'default' => $input_year,

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

