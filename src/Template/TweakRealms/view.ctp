<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TweakRealm $tweakRealm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tweak Realm'), ['action' => 'edit', $tweakRealm->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tweak Realm'), ['action' => 'delete', $tweakRealm->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tweakRealm->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tweak Realms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tweak Realm'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tweaks'), ['controller' => 'Tweaks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tweak'), ['controller' => 'Tweaks', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tweakRealms view large-9 medium-8 columns content">
    <h3><?= h($tweakRealm->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tweak') ?></th>
            <td><?= $tweakRealm->has('tweak') ? $this->Html->link($tweakRealm->tweak->name, ['controller' => 'Tweaks', 'action' => 'view', $tweakRealm->tweak->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realm') ?></th>
            <td><?= $tweakRealm->has('realm') ? $this->Html->link($tweakRealm->realm->name, ['controller' => 'Realms', 'action' => 'view', $tweakRealm->realm->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tweakRealm->id) ?></td>
        </tr>
    </table>
</div>
