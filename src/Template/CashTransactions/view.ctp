<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashTransaction $cashTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cash Transaction'), ['action' => 'edit', $cashTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cash Transaction'), ['action' => 'delete', $cashTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cashTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cash Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cash Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cashTransactions view large-9 medium-8 columns content">
    <h3><?= h($cashTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $cashTransaction->has('user') ? $this->Html->link($cashTransaction->user->name, ['controller' => 'Users', 'action' => 'view', $cashTransaction->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cashTransaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partner User Id') ?></th>
            <td><?= $this->Number->format($cashTransaction->partner_user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payable') ?></th>
            <td><?= $this->Number->format($cashTransaction->payable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receivable') ?></th>
            <td><?= $this->Number->format($cashTransaction->receivable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Received') ?></th>
            <td><?= $this->Number->format($cashTransaction->received) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($cashTransaction->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference') ?></th>
            <td><?= $this->Number->format($cashTransaction->reference) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($cashTransaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($cashTransaction->modified) ?></td>
        </tr>
    </table>
</div>
