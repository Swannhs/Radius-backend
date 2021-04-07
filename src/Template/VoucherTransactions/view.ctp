<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoucherTransaction $voucherTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Voucher Transaction'), ['action' => 'edit', $voucherTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Voucher Transaction'), ['action' => 'delete', $voucherTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $voucherTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Voucher Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Voucher Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="voucherTransactions view large-9 medium-8 columns content">
    <h3><?= h($voucherTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $voucherTransaction->has('user') ? $this->Html->link($voucherTransaction->user->name, ['controller' => 'Users', 'action' => 'view', $voucherTransaction->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realm') ?></th>
            <td><?= $voucherTransaction->has('realm') ? $this->Html->link($voucherTransaction->realm->name, ['controller' => 'Realms', 'action' => 'view', $voucherTransaction->realm->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile') ?></th>
            <td><?= $voucherTransaction->has('profile') ? $this->Html->link($voucherTransaction->profile->name, ['controller' => 'Profiles', 'action' => 'view', $voucherTransaction->profile->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($voucherTransaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credit') ?></th>
            <td><?= $this->Number->format($voucherTransaction->credit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Debit') ?></th>
            <td><?= $this->Number->format($voucherTransaction->debit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity Rate') ?></th>
            <td><?= $this->Number->format($voucherTransaction->quantity_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Balance') ?></th>
            <td><?= $this->Number->format($voucherTransaction->balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($voucherTransaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($voucherTransaction->modified) ?></td>
        </tr>
    </table>
</div>
