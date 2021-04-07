<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceTransactionDetail[]|\Cake\Collection\CollectionInterface $balanceTransactionDetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Balance Transaction Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="balanceTransactionDetails index large-9 medium-8 columns content">
    <h3><?= __('Balance Transaction Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sender_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('realm_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profile_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receivable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($balanceTransactionDetails as $balanceTransactionDetail): ?>
            <tr>
                <td><?= $this->Number->format($balanceTransactionDetail->id) ?></td>
                <td><?= h($balanceTransactionDetail->transaction) ?></td>
                <td><?= $this->Number->format($balanceTransactionDetail->sender_user_id) ?></td>
                <td><?= $balanceTransactionDetail->has('user') ? $this->Html->link($balanceTransactionDetail->user->name, ['controller' => 'Users', 'action' => 'view', $balanceTransactionDetail->user->id]) : '' ?></td>
                <td><?= $balanceTransactionDetail->has('realm') ? $this->Html->link($balanceTransactionDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $balanceTransactionDetail->realm->id]) : '' ?></td>
                <td><?= $balanceTransactionDetail->has('profile') ? $this->Html->link($balanceTransactionDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $balanceTransactionDetail->profile->id]) : '' ?></td>
                <td><?= $this->Number->format($balanceTransactionDetail->payable) ?></td>
                <td><?= $this->Number->format($balanceTransactionDetail->receivable) ?></td>
                <td><?= h($balanceTransactionDetail->created) ?></td>
                <td><?= h($balanceTransactionDetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $balanceTransactionDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $balanceTransactionDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $balanceTransactionDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $balanceTransactionDetail->id)]) ?>
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
