<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
$this->assign('title', __('Add User'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Users', 'url' => ['action' => 'index']],
    ['title' => 'Add'],
]);
?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($user) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('username');
      echo $this->Form->control('password');
      echo $this->Form->control('start_date');
      echo $this->Form->control('end_date', ['empty' => true]);
      echo $this->Form->control('is_admin', ['custom' => true]);
      echo $this->Form->control('admin_level');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

<div class="card card-primary card-outline">
  <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
          <thead>
              <tr>
                  <th><?= $this->Paginator->sort('id') ?></th>
                  <th><?= $this->Paginator->sort('username') ?></th>
                  <th><?= $this->Paginator->sort('start_date') ?></th>
                  <th><?= $this->Paginator->sort('end_date') ?></th>
                  <th><?= $this->Paginator->sort('is_admin') ?></th>
                  <th><?= $this->Paginator->sort('admin_level') ?></th>
                  <th class="actions"><?= __('Actions') ?></th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($users as $user) : ?>
                  <tr>
                      <td><?= $this->Number->format($user->id) ?></td>
                      <td><?= h($user->username) ?></td>
                      <td><?= h($user->start_date) ?></td>
                      <td><?= h($user->end_date) ?></td>
                      <td><?= ($user->is_admin) ? __('Yes') : __('No') ?></td>
                      <td><?= $this->Number->format($user->admin_level) ?></td>
                      <td class="actions">
                          <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                          <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?>
                          <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                      </td>
                  </tr>
              <?php endforeach; ?>
          </tbody>
      </table>
  </div>
</div>
  <!-- /.card-body -->