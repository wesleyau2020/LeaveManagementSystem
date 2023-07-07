<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeaveRequest $leaveRequest
 */
?>
<?php
$this->assign('title', __('Search Leave Request'));
$this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => '/'],
    ['title' => 'List Leave Requests', 'url' => ['action' => 'index']],
    // ['title' => 'View', 'url' => ['action' => 'view', $leaveRequest->id]],
    ['title' => 'Search'],
]);
?>

<div class="card card-primary card-outline">
  <div class="card-body">
    <?= $this->Form->create(null, ['url' => ['controller' => 'LeaveRequests', 'action' => 'search'], 'type' => 'get']) ?>
    <?= $this->Form->control('id', ['label' => 'ID']) ?>
    <?= $this->Form->button(__('Search')) ?>
    <?= $this->Form->end() ?>
  </div>
</div>

