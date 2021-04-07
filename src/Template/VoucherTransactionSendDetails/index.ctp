<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoucherTransactionSendDetail[]|\Cake\Collection\CollectionInterface $voucherTransactionSendDetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Voucher Transaction Send Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="voucherTransactionSendDetails index large-9 medium-8 columns content">
    <h3><?= __('Voucher Transaction Send Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sender_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('realm_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profile_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('credit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('debit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity_rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($voucherTransactionSendDetails as $voucherTransactionSendDetail): ?>
            <tr>
                <td><?= $this->Number->format($voucherTransactionSendDetail->id) ?></td>
                <td><?= h($voucherTransactionSendDetail->transaction) ?></td>
                <td><?= $this->Number->format($voucherTransactionSendDetail->sender_user_id) ?></td>
                <td><?= $voucherTransactionSendDetail->has('user') ? $this->Html->link($voucherTransactionSendDetail->user->name, ['controller' => 'Users', 'action' => 'view', $voucherTransactionSendDetail->user->id]) : '' ?></td>
                <td><?= $voucherTransactionSendDetail->has('realm') ? $this->Html->link($voucherTransactionSendDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $voucherTransactionSendDetail->realm->id]) : '' ?></td>
                <td><?= $voucherTransactionSendDetail->has('profile') ? $this->Html->link($voucherTransactionSendDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $voucherTransactionSendDetail->profile->id]) : '' ?></td>
                <td><?= $this->Number->format($voucherTransactionSendDetail->credit) ?></td>
                <td><?= $this->Number->format($voucherTransactionSendDetail->debit) ?></td>
                <td><?= $this->Number->format($voucherTransactionSendDetail->quantity_rate) ?></td>
                <td><?= $this->Number->format($voucherTransactionSendDetail->balance) ?></td>
                <td><?= h($voucherTransactionSendDetail->created) ?></td>
                <td><?= h($voucherTransactionSendDetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $voucherTransactionSendDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $voucherTransactionSendDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $voucherTransactionSendDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $voucherTransactionSendDetail->id)]) ?>
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
