<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
$this->assign('title', __('Edit User'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Users', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $user->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($user) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('username');
      echo $this->Form->control('password');
      // echo $this->Form->control('start_date');
      // echo $this->Form->control('end_date', ['empty' => true]);
      // echo $this->Form->control('is_admin', ['custom' => true]);
      // echo $this->Form->control('admin_level');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

