<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoucherTransactionReceivedDetail $voucherTransactionReceivedDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Voucher Transaction Received Detail'), ['action' => 'edit', $voucherTransactionReceivedDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Voucher Transaction Received Detail'), ['action' => 'delete', $voucherTransactionReceivedDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $voucherTransactionReceivedDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Voucher Transaction Received Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Voucher Transaction Received Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="voucherTransactionReceivedDetails view large-9 medium-8 columns content">
    <h3><?= h($voucherTransactionReceivedDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= h($voucherTransactionReceivedDetail->transaction) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $voucherTransactionReceivedDetail->has('user') ? $this->Html->link($voucherTransactionReceivedDetail->user->name, ['controller' => 'Users', 'action' => 'view', $voucherTransactionReceivedDetail->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realm') ?></th>
            <td><?= $voucherTransactionReceivedDetail->has('realm') ? $this->Html->link($voucherTransactionReceivedDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $voucherTransactionReceivedDetail->realm->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile') ?></th>
            <td><?= $voucherTransactionReceivedDetail->has('profile') ? $this->Html->link($voucherTransactionReceivedDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $voucherTransactionReceivedDetail->profile->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($voucherTransactionReceivedDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver User Id') ?></th>
            <td><?= $this->Number->format($voucherTransactionReceivedDetail->receiver_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credit') ?></th>
            <td><?= $this->Number->format($voucherTransactionReceivedDetail->credit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Debit') ?></th>
            <td><?= $this->Number->format($voucherTransactionReceivedDetail->debit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity Rate') ?></th>
            <td><?= $this->Number->format($voucherTransactionReceivedDetail->quantity_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Balance') ?></th>
            <td><?= $this->Number->format($voucherTransactionReceivedDetail->balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($voucherTransactionReceivedDetail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($voucherTransactionReceivedDetail->modified) ?></td>
        </tr>
    </table>
</div>
