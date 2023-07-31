<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest $leaveRequest
 */

/** @var string inputYear */
$inputYear = $_POST["inputYear"]??date('Y');
?>
<?php
$this->assign('title', __('Add Leave Request'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($leaveRequest) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('leave_type_id', ['options' => $leaveType]);
      echo $this->Form->control('start_of_leave');
      echo $this->Form->control('end_of_leave');
      echo $this->Form->control('year');
      echo $this->Form->control('description');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'add'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

<div class="card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <div style="padding:5px">
            <?php $title = ($user->username).'\'s Leave Requests ('.$inputYear .')'?>
            <h3 class="card-title"><?= __("").$title?></h3>
        </div>
        <div class="card-toolbox">  
            <!--  -->
        </div>
    </div>
    <!-- /.card-header -->
    
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('leave_type') ?></th>
                    <th><?= $this->Paginator->sort('days') ?></th>
                    <th><?= $this->Paginator->sort('start_of_leave') ?></th>
                    <th><?= $this->Paginator->sort('end_of_leave') ?></th>
                    <th><?= $this->Paginator->sort('remark') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userLeaveRequests as $leaveRequest) : ?>
                    <?php if ($leaveRequest->year === $inputYear): ?>
                    <tr>
                        <td><?= $this->Number->format($leaveRequest->id) ?></td>
                        <td><?= h($leaveRequest->description) ?></td>
                        <td><?= h($leaveRequest->status) ?></td>
                        <td><?= h($leaveRequest->leave_type->name) ?></td>
                        <td><?= $this->Number->format($leaveRequest->days) ?></td>
                        <td><?= h($leaveRequest->start_of_leave) ?></td>
                        <td><?= h($leaveRequest->end_of_leave) ?></td>
                        <td><?= h($leaveRequest->remark) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveRequest->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $leaveRequest->id)]) ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    <div class="card-footer d-flex">
        <div class="">
        </div>
        <div class="ml-auto">
            <!-- select year via dropdown menu -->
            <div style="float:left">
            <?= 
                $this->Form->create(null, [
                    'type' => 'post',
                    'valueSources' => ['query', 'data'],
                    // TODO: Action should be 'add/' but changing it will intefere with controller code
                    'url' => ['action' => 'index/'],
                    'style' => "margin-right: 5px"
                ])
            ?>
            <?=
                $this->Form->year('inputYear', [
                    'min' => 2000,
                    'max' => date('Y'),
                    'default' => $inputYear
                ])
            ?>
            </div>
            <div style="float:right">
                <?php
                    echo $this->Form->button('Submit');
                    echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
    <!-- /.card-footer -->
</div>