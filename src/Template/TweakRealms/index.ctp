<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TweakRealm[]|\Cake\Collection\CollectionInterface $tweakRealms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tweak Realm'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tweaks'), ['controller' => 'Tweaks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tweak'), ['controller' => 'Tweaks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tweakRealms index large-9 medium-8 columns content">
    <h3><?= __('Tweak Realms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tweak_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('realm_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tweakRealms as $tweakRealm): ?>
            <tr>
                <td><?= $this->Number->format($tweakRealm->id) ?></td>
                <td><?= $tweakRealm->has('tweak') ? $this->Html->link($tweakRealm->tweak->name, ['controller' => 'Tweaks', 'action' => 'view', $tweakRealm->tweak->id]) : '' ?></td>
                <td><?= $tweakRealm->has('realm') ? $this->Html->link($tweakRealm->realm->name, ['controller' => 'Realms', 'action' => 'view', $tweakRealm->realm->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tweakRealm->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tweakRealm->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tweakRealm->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tweakRealm->id)]) ?>
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
