<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Holiday[]|\Cake\Collection\CollectionInterface $holidays
 */

/** @var string inputYear */
$inputYear = $_POST["inputYear"]??date('Y');
?>
<?php
$this->assign('title', __('Holidays'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Holidays'],
]);
?>

<div class="card card-primary card-outline">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('start_date') ?></th>
                    <th><?= $this->Paginator->sort('end_date') ?></th>
                    <th><?= $this->Paginator->sort('is_holiday') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($holidays as $holiday) : ?>
                    <tr>
                        <td><?= $this->Number->format($holiday->id) ?></td>
                        <td><?= h($holiday->start_date) ?></td>
                        <td><?= h($holiday->end_date) ?></td>
                        <td><?= ($holiday->is_holiday) ? __('Yes') : __('No') ?></td>
                        <td><?= h($holiday->description) ?></td>
                        <td class="actions">
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $holiday->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $holiday->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer d-flex">
        <div class="" style="float: left">
        <?= $this->Html->link(__('Display Calendar'), ['action' => 'display'], ['class' => 'btn btn-primary btn-m'], ['style' => 'float: left']) ?>
        </div>
        <div class="ml-auto">
            <!-- select year via dropdown menu -->
            <div style="float: left">
                <?= 
                    $this->Form->create(null, [
                        'type' => 'post',
                        'valueSources' => ['query', 'data'],
                        'url' => ['action' => 'delete_index'],
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
    <!-- /.card-footer -->
    </div>
</div>