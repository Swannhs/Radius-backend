<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServerRealm[]|\Cake\Collection\CollectionInterface $serverRealms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Server Realm'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Servers'), ['controller' => 'Servers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Server'), ['controller' => 'Servers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="serverRealms index large-9 medium-8 columns content">
    <h3><?= __('Server Realms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('server_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('realm_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($serverRealms as $serverRealm): ?>
            <tr>
                <td><?= $this->Number->format($serverRealm->id) ?></td>
                <td><?= $serverRealm->has('server') ? $this->Html->link($serverRealm->server->name, ['controller' => 'Servers', 'action' => 'view', $serverRealm->server->id]) : '' ?></td>
                <td><?= $serverRealm->has('realm') ? $this->Html->link($serverRealm->realm->name, ['controller' => 'Realms', 'action' => 'view', $serverRealm->realm->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $serverRealm->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $serverRealm->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $serverRealm->id], ['confirm' => __('Are you sure you want to delete # {0}?', $serverRealm->id)]) ?>
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
