<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Server[]|\Cake\Collection\CollectionInterface $servers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Server'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Server Realms'), ['controller' => 'ServerRealms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Server Realm'), ['controller' => 'ServerRealms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="servers index large-9 medium-8 columns content">
    <h3><?= __('Servers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cc') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ssl_port') ?></th>
                <th scope="col"><?= $this->Paginator->sort('proxy_port') ?></th>
                <th scope="col"><?= $this->Paginator->sort('api_server_port') ?></th>
                <th scope="col"><?= $this->Paginator->sort('note') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servers as $server): ?>
            <tr>
                <td><?= $this->Number->format($server->id) ?></td>
                <td><?= h($server->type) ?></td>
                <td><?= h($server->name) ?></td>
                <td><?= h($server->cc) ?></td>
                <td><?= h($server->ip) ?></td>
                <td><?= h($server->ssl_port) ?></td>
                <td><?= h($server->proxy_port) ?></td>
                <td><?= h($server->api_server_port) ?></td>
                <td><?= h($server->note) ?></td>
                <td><?= h($server->created) ?></td>
                <td><?= h($server->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $server->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $server->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $server->id], ['confirm' => __('Are you sure you want to delete # {0}?', $server->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
