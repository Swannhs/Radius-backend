<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoucherTransaction[]|\Cake\Collection\CollectionInterface $voucherTransactions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Voucher Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="voucherTransactions index large-9 medium-8 columns content">
    <h3><?= __('Voucher Transactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('credit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('debit') ?></th>
                <th scope="col"><?= $this->Paginator->sort('realm_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profile_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity_rate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('balance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($voucherTransactions as $voucherTransaction): ?>
            <tr>
                <td><?= $this->Number->format($voucherTransaction->id) ?></td>
                <td><?= $voucherTransaction->has('user') ? $this->Html->link($voucherTransaction->user->name, ['controller' => 'Users', 'action' => 'view', $voucherTransaction->user->id]) : '' ?></td>
                <td><?= $this->Number->format($voucherTransaction->credit) ?></td>
                <td><?= $this->Number->format($voucherTransaction->debit) ?></td>
                <td><?= $voucherTransaction->has('realm') ? $this->Html->link($voucherTransaction->realm->name, ['controller' => 'Realms', 'action' => 'view', $voucherTransaction->realm->id]) : '' ?></td>
                <td><?= $voucherTransaction->has('profile') ? $this->Html->link($voucherTransaction->profile->name, ['controller' => 'Profiles', 'action' => 'view', $voucherTransaction->profile->id]) : '' ?></td>
                <td><?= $this->Number->format($voucherTransaction->quantity_rate) ?></td>
                <td><?= $this->Number->format($voucherTransaction->balance) ?></td>
                <td><?= h($voucherTransaction->created) ?></td>
                <td><?= h($voucherTransaction->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $voucherTransaction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $voucherTransaction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $voucherTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $voucherTransaction->id)]) ?>
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
