<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$toggleActive = $_POST["toggleActive"]??true;
?>
<?php
$this->assign('title', __('Add User'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Users', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($user) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('username');
      echo $this->Form->control('password');
      echo $this->Form->control('start_date');
      echo $this->Form->control('end_date', ['empty' => true]);
      echo $this->Form->control('is_admin', ['custom' => true]);
      echo $this->Form->control('admin_level');
    ?>
  </div>

  <div class="card-footer d-flex">    
    <div class="" style="float: left">
      <?= $this->Html->link(__('Display Active Users'), ['action' => 'displayActiveUsers'], ['class' => 'btn btn-primary btn-sm'], ['style' => 'float:left']) ?>
      <?= $this->Html->link(__('Display Inactive Users'), ['action' => 'displayInactiveUsers'], ['class' => 'btn btn-sm btn-danger'], ['style' => 'float:left']) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>