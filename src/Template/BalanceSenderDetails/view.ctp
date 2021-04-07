<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceSenderDetail $balanceSenderDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Balance Sender Detail'), ['action' => 'edit', $balanceSenderDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Balance Sender Detail'), ['action' => 'delete', $balanceSenderDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $balanceSenderDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Balance Sender Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Balance Sender Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="balanceSenderDetails view large-9 medium-8 columns content">
    <h3><?= h($balanceSenderDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= h($balanceSenderDetail->transaction) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $balanceSenderDetail->has('user') ? $this->Html->link($balanceSenderDetail->user->name, ['controller' => 'Users', 'action' => 'view', $balanceSenderDetail->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realm') ?></th>
            <td><?= $balanceSenderDetail->has('realm') ? $this->Html->link($balanceSenderDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $balanceSenderDetail->realm->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile') ?></th>
            <td><?= $balanceSenderDetail->has('profile') ? $this->Html->link($balanceSenderDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $balanceSenderDetail->profile->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($balanceSenderDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sender User Id') ?></th>
            <td><?= $this->Number->format($balanceSenderDetail->sender_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payable') ?></th>
            <td><?= $this->Number->format($balanceSenderDetail->payable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receivable') ?></th>
            <td><?= $this->Number->format($balanceSenderDetail->receivable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Received') ?></th>
            <td><?= $this->Number->format($balanceSenderDetail->received) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sent') ?></th>
            <td><?= $this->Number->format($balanceSenderDetail->sent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= $this->Number->format($balanceSenderDetail->reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($balanceSenderDetail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($balanceSenderDetail->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $balanceSenderDetail->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
