<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\VoucherTransactionReceivedDetail[]|\Cake\Collection\CollectionInterface $voucherTransactionReceivedDetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Voucher Transaction Received Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="voucherTransactionReceivedDetails index large-9 medium-8 columns content">
    <h3><?= __('Voucher Transaction Received Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_user_id') ?></th>
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
            <?php foreach ($voucherTransactionReceivedDetails as $voucherTransactionReceivedDetail): ?>
            <tr>
                <td><?= $this->Number->format($voucherTransactionReceivedDetail->id) ?></td>
                <td><?= h($voucherTransactionReceivedDetail->transaction) ?></td>
                <td><?= $this->Number->format($voucherTransactionReceivedDetail->receiver_user_id) ?></td>
                <td><?= $voucherTransactionReceivedDetail->has('user') ? $this->Html->link($voucherTransactionReceivedDetail->user->name, ['controller' => 'Users', 'action' => 'view', $voucherTransactionReceivedDetail->user->id]) : '' ?></td>
                <td><?= $voucherTransactionReceivedDetail->has('realm') ? $this->Html->link($voucherTransactionReceivedDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $voucherTransactionReceivedDetail->realm->id]) : '' ?></td>
                <td><?= $voucherTransactionReceivedDetail->has('profile') ? $this->Html->link($voucherTransactionReceivedDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $voucherTransactionReceivedDetail->profile->id]) : '' ?></td>
                <td><?= $this->Number->format($voucherTransactionReceivedDetail->credit) ?></td>
                <td><?= $this->Number->format($voucherTransactionReceivedDetail->debit) ?></td>
                <td><?= $this->Number->format($voucherTransactionReceivedDetail->quantity_rate) ?></td>
                <td><?= $this->Number->format($voucherTransactionReceivedDetail->balance) ?></td>
                <td><?= h($voucherTransactionReceivedDetail->created) ?></td>
                <td><?= h($voucherTransactionReceivedDetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $voucherTransactionReceivedDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $voucherTransactionReceivedDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $voucherTransactionReceivedDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $voucherTransactionReceivedDetail->id)]) ?>
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
