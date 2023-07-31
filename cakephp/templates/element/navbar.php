<!-- src/Template/Element/navbar.ctp -->
<nav>
    <ul>
        <li class="nav-item d-none d-sm-inline-block">
        <?= $this->Html->link(__('Home'), '/', ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <?= $this->Html->link(__('User'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <?= $this->Html->link(__('Leave Request'), ['controller' => 'LeaveRequests', 'action' => 'index'] ,['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <?= $this->Html->link(__('Leave Details'), ['controller' => 'LeaveDetails', 'action' => 'index'] ,['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'] ,['class' => 'nav-link']) ?>
        </li>
    </ul>
</nav>
