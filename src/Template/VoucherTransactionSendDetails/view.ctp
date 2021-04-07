<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoucherTransactionSendDetail $voucherTransactionSendDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Voucher Transaction Send Detail'), ['action' => 'edit', $voucherTransactionSendDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Voucher Transaction Send Detail'), ['action' => 'delete', $voucherTransactionSendDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $voucherTransactionSendDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Voucher Transaction Send Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Voucher Transaction Send Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="voucherTransactionSendDetails view large-9 medium-8 columns content">
    <h3><?= h($voucherTransactionSendDetail->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= h($voucherTransactionSendDetail->transaction) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $voucherTransactionSendDetail->has('user') ? $this->Html->link($voucherTransactionSendDetail->user->name, ['controller' => 'Users', 'action' => 'view', $voucherTransactionSendDetail->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Realm') ?></th>
            <td><?= $voucherTransactionSendDetail->has('realm') ? $this->Html->link($voucherTransactionSendDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $voucherTransactionSendDetail->realm->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Profile') ?></th>
            <td><?= $voucherTransactionSendDetail->has('profile') ? $this->Html->link($voucherTransactionSendDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $voucherTransactionSendDetail->profile->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($voucherTransactionSendDetail->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sender User Id') ?></th>
            <td><?= $this->Number->format($voucherTransactionSendDetail->sender_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credit') ?></th>
            <td><?= $this->Number->format($voucherTransactionSendDetail->credit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Debit') ?></th>
            <td><?= $this->Number->format($voucherTransactionSendDetail->debit) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity Rate') ?></th>
            <td><?= $this->Number->format($voucherTransactionSendDetail->quantity_rate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Balance') ?></th>
            <td><?= $this->Number->format($voucherTransactionSendDetail->balance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($voucherTransactionSendDetail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($voucherTransactionSendDetail->modified) ?></td>
        </tr>
    </table>
</div>
