<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceTransaction $balanceTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $balanceTransaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $balanceTransaction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Balance Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="balanceTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($balanceTransaction) ?>
    <fieldset>
        <legend><?= __('Edit Balance Transaction') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('payable');
            echo $this->Form->control('receivable');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
