<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Workday[]|\Cake\Collection\CollectionInterface $workdays
 */
?>
<?php
$this->assign('title', __('Workdays'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Workdays', 'url' => ['action' => 'index']],
    ['title' => 'Set'],
]);
?>

<div class="card card-primary card-outline">
    <?php
    echo $this->Form->create($form);
    foreach ($workdays as $workday) {
        echo $this->Form->control('id', ['workday' => $workday->id]);
        echo $this->Form->checkbox('is_workday', ['value' => $workday->is_workday]);
    }
    echo $this->Form->submit('Change');
    echo $this->Form->end();
    ?>
    <!-- /.card-footer -->
</div>
