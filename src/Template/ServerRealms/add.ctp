<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServerRealm $serverRealm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Server Realms'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Servers'), ['controller' => 'Servers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Server'), ['controller' => 'Servers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="serverRealms form large-9 medium-8 columns content">
    <?= $this->Form->create($serverRealm) ?>
    <fieldset>
        <legend><?= __('Add Server Realm') ?></legend>
        <?php
            echo $this->Form->control('server_id', ['options' => $servers]);
            echo $this->Form->control('realm_id', ['options' => $realms]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
