<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Calendar $calendar
 */
?>
<?php
$this->assign('title', __('Edit Calendar'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Calendar', 'url' => ['action' => 'index']],
    ['title' => 'View', 'url' => ['action' => 'view', $calendar->id]],
    ['title' => 'Edit'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($calendar) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('title');
      echo $this->Form->control('description');
      echo $this->Form->control('start_date');
      echo $this->Form->control('end_date');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $calendar->id],
          ['confirm' => __('Are you sure you want to delete # {0}?', $calendar->id), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

