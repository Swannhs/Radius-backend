<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceTransaction $balanceTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Balance Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="balanceTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($balanceTransaction) ?>
    <fieldset>
        <legend><?= __('Add Balance Transaction') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('payable');
            echo $this->Form->control('receivable');
            echo $this->Form->control('received');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
