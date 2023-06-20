<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workday $workday
 */
?>
<?php
$this->assign('title', __('Edit Workday'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Workdays', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $workday->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?php foreach ($workdays as $workday) : ?>
    <?= $this->Form->create($workday) ?>
    <div class="card-body">
      <?php
        echo $this->Form->control('day_of_week');
        echo $this->Form->control('is_workday', ['custom' => true]);
      ?>
    </div>

    <div class="card-footer d-flex">
      <div class="">
        <?= $this->Form->postLink(
            __('Delete'),
            ['action' => 'delete', $workday->id],
            ['confirm' => __('Are you sure you want to delete # {0}?', $workday->id), 'class' => 'btn btn-danger']
        ) ?>
      </div>
      <div class="ml-auto">
        <?= $this->Form->button(__('Save')) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
      </div>
    </div>

    <?= $this->Form->end() ?>
  <?php endforeach; ?>
</div>

