<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Server $server
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Server'), ['action' => 'edit', $server->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Server'), ['action' => 'delete', $server->id], ['confirm' => __('Are you sure you want to delete # {0}?', $server->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Servers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Server'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Server Realms'), ['controller' => 'ServerRealms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Server Realm'), ['controller' => 'ServerRealms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="servers view large-9 medium-8 columns content">
    <h3><?= h($server->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($server->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($server->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cc') ?></th>
            <td><?= h($server->cc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip') ?></th>
            <td><?= h($server->ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ssl Port') ?></th>
            <td><?= h($server->ssl_port) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Proxy Port') ?></th>
            <td><?= h($server->proxy_port) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Api Server Port') ?></th>
            <td><?= h($server->api_server_port) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Note') ?></th>
            <td><?= h($server->note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($server->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($server->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($server->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Server Realms') ?></h4>
        <?php if (!empty($server->server_realms)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Server Id') ?></th>
                <th scope="col"><?= __('Realm Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($server->server_realms as $serverRealms): ?>
            <tr>
                <td><?= h($serverRealms->id) ?></td>
                <td><?= h($serverRealms->server_id) ?></td>
                <td><?= h($serverRealms->realm_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ServerRealms', 'action' => 'view', $serverRealms->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ServerRealms', 'action' => 'edit', $serverRealms->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ServerRealms', 'action' => 'delete', $serverRealms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $serverRealms->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
