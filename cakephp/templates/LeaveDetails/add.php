<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveDetail $leaveDetail
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Leave Details'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leaveDetails form content">
            <?= $this->Form->create($leaveDetail) ?>
            <fieldset>
                <legend><?= __('Add Leave Detail') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('year');
                    echo $this->Form->control('carried_over');
                    echo $this->Form->control('max_carry_over');
                    echo $this->Form->control('num_AL_given');
                    echo $this->Form->control('num_AL_left');
                    echo $this->Form->control('num_ML_given');
                    echo $this->Form->control('num_ML_left');
                    echo $this->Form->control('num_HL_given');
                    echo $this->Form->control('num_HL_left');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
