<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest $leaveRequest
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Leave Requests'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leaveRequests form content">
            <?= $this->Form->create($leaveRequest) ?>
            <fieldset>
                <legend><?= __('Add Leave Request') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('leave_type');
                    echo $this->Form->control('start_of_leave');
                    echo $this->Form->control('end_of_leave');
                    echo $this->Form->control('num_days');
                    echo $this->Form->control('year');
                    echo $this->Form->control('description');
                    echo $this->Form->control('status');
                    echo $this->Form->control('remark');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
