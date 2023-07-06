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
    <?= $this->Form->create($workdays) ?>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('ID') ?></th>
                        <th><?= $this->Paginator->sort('day_of_week') ?></th>
                        <th><?= $this->Paginator->sort('is_workday') ?></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($workdays as $workday) : ?>
                        <tr>
                            <td>
                                <?= $this->Number->format($workday->id) ?>
                            </td>
                            <td>
                                <?= h($workday->day_of_week) ?>
                            </td>
                            <td>
                                <?= $this->Form->checkbox($workday->id, ['default' => $workday->is_workday]); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer d-flex">
            <div class="ml-auto">
                <?= $this->Form->button(__('Save')) ?>
                <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
        <!-- /.card-footer -->
    <?= $this->Form->end() ?>
</div>
