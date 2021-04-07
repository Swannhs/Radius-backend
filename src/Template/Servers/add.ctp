<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Server $server
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Servers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Server Realms'), ['controller' => 'ServerRealms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Server Realm'), ['controller' => 'ServerRealms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="servers form large-9 medium-8 columns content">
    <?= $this->Form->create($server) ?>
    <fieldset>
        <legend><?= __('Add Server') ?></legend>
        <?php
            echo $this->Form->control('type');
            echo $this->Form->control('name');
            echo $this->Form->control('cc');
            echo $this->Form->control('ip');
            echo $this->Form->control('ssl_port');
            echo $this->Form->control('proxy_port');
            echo $this->Form->control('api_server_port');
            echo $this->Form->control('note');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
