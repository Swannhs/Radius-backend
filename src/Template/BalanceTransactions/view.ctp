<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceTransaction $balanceTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Balance Transaction'), ['action' => 'edit', $balanceTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Balance Transaction'), ['action' => 'delete', $balanceTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $balanceTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Balance Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Balance Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="balanceTransactions view large-9 medium-8 columns content">
    <h3><?= h($balanceTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $balanceTransaction->has('user') ? $this->Html->link($balanceTransaction->user->name, ['controller' => 'Users', 'action' => 'view', $balanceTransaction->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($balanceTransaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payable') ?></th>
            <td><?= $this->Number->format($balanceTransaction->payable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receivable') ?></th>
            <td><?= $this->Number->format($balanceTransaction->receivable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($balanceTransaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($balanceTransaction->modified) ?></td>
        </tr>
    </table>
</div>
