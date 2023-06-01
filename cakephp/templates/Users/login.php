<?php

/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg"><?= __('Sign in to start your session') ?></p>

        <?= $this->Form->create() ?>

        <?= $this->Form->control('username', [
            'label' => false,
            'placeholder' => __('Username'),
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('password', [
            'label' => false,
            'placeholder' => __('Password'),
            'append' => '<i class="fas fa-lock"></i>',
        ]) ?>

        <div class="row">
            <!-- <div class="col-8">
                <?= $this->Form->control('remember_me', ['type' => 'checkbox', 'custom' => true]) ?>
            </div> -->
            <div class="col-4">
                <?= $this->Form->control(__('Sign In'), ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>
    </div>
    <!-- /.login-card-body -->
</div>