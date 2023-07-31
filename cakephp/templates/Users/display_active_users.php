<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$toggleActive = $_POST["toggleActive"]??true;
?>
<?php
$this->assign('title', __('Active Users'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Users', 'url' => ['action' => 'index']],
    ['title' => 'Display Active Users'],
]);
?>

<div class="card card-primary card-outline">
  <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
          <thead>
              <tr>
                  <th><?= $this->Paginator->sort('ID') ?></th>
                  <th><?= $this->Paginator->sort('username') ?></th>
                  <th><?= $this->Paginator->sort('start_date') ?></th>
                  <th><?= $this->Paginator->sort('end_date') ?></th>
                  <th><?= $this->Paginator->sort('is_admin') ?></th>
                  <th><?= $this->Paginator->sort('admin_level') ?></th>
                  <th class="actions"><?= __('Actions') ?></th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($activeUsers as $user) : ?>
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
  <div class="card-footer d-flex">
    <div class="ml-auto">
      <div>
        <!-- Toggle button to switch between active/inactive users -->
        <?= $this->Form->create(null, ['url' => ['controller' => 'users', 'action' => '/displayInactiveUsers']]); ?>
        <?= $this->Html->link(__('Display Inactive Users'), ['action' => 'displayInactiveUsers'], ['class' => 'btn btn-m btn-danger']) ?>
        <?= $this->Form->end(); ?>
      </div>
    </div>
    <div class="" style="float: right; margin-left: 10px">
      <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-m']) ?>
    </div>
  </div>
</div>