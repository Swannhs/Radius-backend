<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceReceiverDetail $balanceReceiverDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Balance Receiver Detail'), ['action' => 'edit', $balanceReceiverDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Balance Receiver Detail'), ['action' => 'delete', $balanceReceiverDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $balanceReceiverDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Balance Receiver Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Balance Receiver Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="balanceReceiverDetails view large-9 medium-8 columns content">
    <h3><?= h($balanceReceiverDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= h($balanceReceiverDetail->transaction) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $balanceReceiverDetail->has('user') ? $this->Html->link($balanceReceiverDetail->user->name, ['controller' => 'Users', 'action' => 'view', $balanceReceiverDetail->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realm') ?></th>
            <td><?= $balanceReceiverDetail->has('realm') ? $this->Html->link($balanceReceiverDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $balanceReceiverDetail->realm->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile') ?></th>
            <td><?= $balanceReceiverDetail->has('profile') ? $this->Html->link($balanceReceiverDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $balanceReceiverDetail->profile->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($balanceReceiverDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver User Id') ?></th>
            <td><?= $this->Number->format($balanceReceiverDetail->receiver_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payable') ?></th>
            <td><?= $this->Number->format($balanceReceiverDetail->payable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receivable') ?></th>
            <td><?= $this->Number->format($balanceReceiverDetail->receivable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Received') ?></th>
            <td><?= $this->Number->format($balanceReceiverDetail->received) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sent') ?></th>
            <td><?= $this->Number->format($balanceReceiverDetail->sent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= $this->Number->format($balanceReceiverDetail->reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($balanceReceiverDetail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($balanceReceiverDetail->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $balanceReceiverDetail->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
