<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceSenderDetail[]|\Cake\Collection\CollectionInterface $balanceSenderDetails
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Balance Sender Detail'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="balanceSenderDetails index large-9 medium-8 columns content">
    <h3><?= __('Balance Sender Details') ?></h3>
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
            <?php foreach ($balanceSenderDetails as $balanceSenderDetail): ?>
            <tr>
                <td><?= $this->Number->format($balanceSenderDetail->id) ?></td>
                <td><?= h($balanceSenderDetail->transaction) ?></td>
                <td><?= $this->Number->format($balanceSenderDetail->sender_user_id) ?></td>
                <td><?= $balanceSenderDetail->has('user') ? $this->Html->link($balanceSenderDetail->user->name, ['controller' => 'Users', 'action' => 'view', $balanceSenderDetail->user->id]) : '' ?></td>
                <td><?= $balanceSenderDetail->has('realm') ? $this->Html->link($balanceSenderDetail->realm->name, ['controller' => 'Realms', 'action' => 'view', $balanceSenderDetail->realm->id]) : '' ?></td>
                <td><?= $balanceSenderDetail->has('profile') ? $this->Html->link($balanceSenderDetail->profile->name, ['controller' => 'Profiles', 'action' => 'view', $balanceSenderDetail->profile->id]) : '' ?></td>
                <td><?= $this->Number->format($balanceSenderDetail->payable) ?></td>
                <td><?= $this->Number->format($balanceSenderDetail->receivable) ?></td>
                <td><?= $this->Number->format($balanceSenderDetail->received) ?></td>
                <td><?= $this->Number->format($balanceSenderDetail->sent) ?></td>
                <td><?= h($balanceSenderDetail->status) ?></td>
                <td><?= $this->Number->format($balanceSenderDetail->reference) ?></td>
                <td><?= h($balanceSenderDetail->created) ?></td>
                <td><?= h($balanceSenderDetail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $balanceSenderDetail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $balanceSenderDetail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $balanceSenderDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $balanceSenderDetail->id)]) ?>
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
