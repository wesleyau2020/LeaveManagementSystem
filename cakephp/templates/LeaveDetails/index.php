<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveDetail[]|\Cake\Collection\CollectionInterface $leaveDetails
 */
?>
<?php
$this->assign('title', __('Leave Details'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Details'],
]);
?>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title">
            <!-- -->
        </h2>
        <?= $this->Html->link(__('New Leave Detail'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        <div class="card-toolbox">
            <?= $this->Paginator->limitControl([], null, [
                'label' => false,
                'class' => 'form-control-m',
            ]); ?>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('leave_type_id') ?></th>
                    <th><?= $this->Paginator->sort('year') ?></th>
                    <th><?= $this->Paginator->sort('carried_over') ?></th>
                    <th><?= $this->Paginator->sort('max_carry_over') ?></th>
                    <th><?= $this->Paginator->sort('entitled') ?></th>
                    <th><?= $this->Paginator->sort('balance') ?></th>
                    <th><?= $this->Paginator->sort('earned') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaveDetails as $leaveDetail) : ?>
                    <tr>
                        <td><?= $this->Number->format($leaveDetail->id) ?></td>
                        <td><?= $leaveDetail->has('user') ? $this->Html->link($leaveDetail->user->id, ['controller' => 'Users', 'action' => 'view', $leaveDetail->user->id]) : '' ?></td>
                        <td><?= $this->Number->format($leaveDetail->leave_type_id) ?></td>
                        <td><?= h($leaveDetail->year) ?></td>
                        <td><?= $this->Number->format($leaveDetail->carried_over) ?></td>
                        <td><?= $this->Number->format($leaveDetail->max_carry_over) ?></td>
                        <td><?= $this->Number->format($leaveDetail->entitled) ?></td>
                        <td><?= $this->Number->format($leaveDetail->balance) ?></td>
                        <td><?= $this->Number->format($leaveDetail->earned) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $leaveDetail->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveDetail->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveDetail->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $leaveDetail->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer d-md-flex paginator">
        <div class="mr-auto" style="font-size:.8rem">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
        <ul class="pagination pagination-sm">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
    </div>
    <!-- /.card-footer -->
</div>
