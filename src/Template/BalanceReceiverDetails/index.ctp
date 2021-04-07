<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceReceiverDetail[]|\Cake\Collection\CollectionInterface $balanceReceiverDetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Balance Receiver Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="balanceReceiverDetails index large-9 medium-8 columns content">
    <h3><?= __('Balance Receiver Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('realm_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('profile_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receivable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('received') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sent') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reference') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($balanceReceiverDetails as $balanceReceiverDetail): ?>
            <tr>
                <td><?= $this->Number->format($balanceReceiverDetail->id) ?></td>
                <td><?= h($balanceReceiverDetail->transaction) ?></td>
                <td><?= $this->Number->format($balanceReceiverDetail->receiver_user_id) ?></td>
                <td><?= $balanceReceiverDetail->has('user') ? $this->Html->link($balanceReceiverDetail->user->name, ['controller' => 'Users', 'action' => 'view', $balanceReceiverDetail->user->id]) : '' ?></td>
                <td><?= $balanceReceiverDetail->has('realm') ? $this->Html->link($balanceReceiverDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $balanceReceiverDetail->realm->id]) : '' ?></td>
                <td><?= $balanceReceiverDetail->has('profile') ? $this->Html->link($balanceReceiverDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $balanceReceiverDetail->profile->id]) : '' ?></td>
                <td><?= $this->Number->format($balanceReceiverDetail->payable) ?></td>
                <td><?= $this->Number->format($balanceReceiverDetail->receivable) ?></td>
                <td><?= $this->Number->format($balanceReceiverDetail->received) ?></td>
                <td><?= $this->Number->format($balanceReceiverDetail->sent) ?></td>
                <td><?= h($balanceReceiverDetail->status) ?></td>
                <td><?= $this->Number->format($balanceReceiverDetail->reference) ?></td>
                <td><?= h($balanceReceiverDetail->created) ?></td>
                <td><?= h($balanceReceiverDetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $balanceReceiverDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $balanceReceiverDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $balanceReceiverDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $balanceReceiverDetail->id)]) ?>
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
