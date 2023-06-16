<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveDetail $leaveDetail
 */
?>
<?php
$this->assign('title', __('Edit Leave Detail'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Details', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $leaveDetail->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($leaveDetail) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('user_id', ['options' => $users]);
      echo $this->Form->control('leave_type_id');
      echo $this->Form->control('year');
      echo $this->Form->control('carried_over');
      echo $this->Form->control('max_carry_over');
      echo $this->Form->control('entitled');
      echo $this->Form->control('balance');
      echo $this->Form->control('earned');
    ?>
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
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

