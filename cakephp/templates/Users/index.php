<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 * 
 */

/** @var string inputYear */
$inputYear = $_POST["inputYear"]??date('Y');
?>
<?php
$this->assign('title', __('Users'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Users'],
]);
?>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title">
            <!--  -->
        </h2>
        <?= $this->Html->link(__('Add New User'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
        <div class="card-toolbox">
            <div class="ml-auto">
                <!-- select year via dropdown menu -->
                <div style="float: left">
                    <?= 
                        $this->Form->create(null, [
                            'type' => 'post',
                            'valueSources' => ['query', 'data'],
                            'url' => ['action' => 'index/'],
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
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('Name') ?></th>
                    <th><?= $this->Paginator->sort('Carried Over') ?></th>
                    <th><?= $this->Paginator->sort('Entitled') ?></th>
                    <th><?= $this->Paginator->sort('Balance') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userWithLeaveDetails as $user) : ?>
                    <?php foreach ($user->leave_details as $leaveDetail) : ?>
                        <?php if ($leaveDetail->year === $inputYear && $leaveDetail->leave_type_id === 1) : ?>
                            <tr>
                                <td><?= $this->Number->format($user->id) ?></td>
                                <td><?= h($user->username) ?></td>
                                <td><?= h($leaveDetail->carried_over) ?></td>
                                <td><?= h($leaveDetail->entitled) ?></td>
                                <td><?= h($leaveDetail->balance) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer d-flex">
        <div class="">
            <?= $this->Html->link(__('Display Active Users'), ['action' => 'displayActiveUsers'], ['class' => 'btn btn-outline-primary btn-sm']) ?>
            <?= $this->Html->link(__('Display Inactive Users'), ['action' => 'displayInactiveUsers'], ['class' => 'btn btn-outline-danger btn-sm']) ?>
        </div>
    </div>
    <!-- /.card-footer -->
</div>
