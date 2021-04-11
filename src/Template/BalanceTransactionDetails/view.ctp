<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceTransactionDetail $balanceTransactionDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Balance Transaction Detail'), ['action' => 'edit', $balanceTransactionDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Balance Transaction Detail'), ['action' => 'delete', $balanceTransactionDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $balanceTransactionDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Balance Transaction Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Balance Transaction Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="balanceTransactionDetails view large-9 medium-8 columns content">
    <h3><?= h($balanceTransactionDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= h($balanceTransactionDetail->transaction) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $balanceTransactionDetail->has('user') ? $this->Html->link($balanceTransactionDetail->user->name, ['controller' => 'Users', 'action' => 'view', $balanceTransactionDetail->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realm') ?></th>
            <td><?= $balanceTransactionDetail->has('realm') ? $this->Html->link($balanceTransactionDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $balanceTransactionDetail->realm->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile') ?></th>
            <td><?= $balanceTransactionDetail->has('profile') ? $this->Html->link($balanceTransactionDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $balanceTransactionDetail->profile->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($balanceTransactionDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver User Id') ?></th>
            <td><?= $this->Number->format($balanceTransactionDetail->receiver_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vouchers') ?></th>
            <td><?= $this->Number->format($balanceTransactionDetail->vouchers) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity Rate') ?></th>
            <td><?= $this->Number->format($balanceTransactionDetail->quantity_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($balanceTransactionDetail->total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($balanceTransactionDetail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($balanceTransactionDetail->modified) ?></td>
        </tr>
    </table>
</div>
