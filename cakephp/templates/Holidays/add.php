<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Holiday $holiday
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Holidays'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="holidays form content">
            <?= $this->Form->create($holiday) ?>
            <fieldset>
                <legend><?= __('Add Holiday') ?></legend>
                <?php
                    echo $this->Form->control('start_date');
                    echo $this->Form->control('end_date', ['empty' => true]);
                    echo $this->Form->control('is_holiday');
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
