<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServerRealm $serverRealm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Server Realm'), ['action' => 'edit', $serverRealm->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Server Realm'), ['action' => 'delete', $serverRealm->id], ['confirm' => __('Are you sure you want to delete # {0}?', $serverRealm->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Server Realms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Server Realm'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Servers'), ['controller' => 'Servers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Server'), ['controller' => 'Servers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="serverRealms view large-9 medium-8 columns content">
    <h3><?= h($serverRealm->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Server') ?></th>
            <td><?= $serverRealm->has('server') ? $this->Html->link($serverRealm->server->name, ['controller' => 'Servers', 'action' => 'view', $serverRealm->server->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realm') ?></th>
            <td><?= $serverRealm->has('realm') ? $this->Html->link($serverRealm->realm->name, ['controller' => 'Realms', 'action' => 'view', $serverRealm->realm->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($serverRealm->id) ?></td>
        </tr>
    </table>
</div>
