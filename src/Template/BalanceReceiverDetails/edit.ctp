<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BalanceReceiverDetail $balanceReceiverDetail
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $balanceReceiverDetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $balanceReceiverDetail->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Balance Receiver Details'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="balanceReceiverDetails form large-9 medium-8 columns content">
    <?= $this->Form->create($balanceReceiverDetail) ?>
    <fieldset>
        <legend><?= __('Edit Balance Receiver Detail') ?></legend>
        <?php
            echo $this->Form->control('transaction');
            echo $this->Form->control('receiver_user_id');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('realm_id', ['options' => $realms]);
            echo $this->Form->control('profile_id', ['options' => $profiles]);
            echo $this->Form->control('payable');
            echo $this->Form->control('receivable');
            echo $this->Form->control('received');
            echo $this->Form->control('sent');
            echo $this->Form->control('status');
            echo $this->Form->control('reference');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
