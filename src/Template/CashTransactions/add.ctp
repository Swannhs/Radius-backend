<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashTransaction $cashTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cash Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cashTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($cashTransaction) ?>
    <fieldset>
        <legend><?= __('Add Cash Transaction') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('partner_user_id');
            echo $this->Form->control('payable');
            echo $this->Form->control('receivable');
            echo $this->Form->control('received');
            echo $this->Form->control('status');
            echo $this->Form->control('reference');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
