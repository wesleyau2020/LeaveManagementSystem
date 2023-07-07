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
    <!-- <div class="card-header d-sm-flex"> -->
        <!-- <h2 class="card-title"></h2> -->
        <!-- <div class="card-toolbox"></div> -->
    <!-- </div> -->
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
    </div>
    <div class="ml-auto">
        <!-- select year via dropdown menu -->
        <div style="float: left">
        <?= 
            $this->Form->create($user, [
                'type' => 'post',
                'valueSources' => ['query', 'data'],
                'url' => ['action' => 'view/'.($user->id)],
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
    <!-- /.card-footer -->
</div>
