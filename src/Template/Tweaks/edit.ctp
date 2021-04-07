<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tweak $tweak
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tweak->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tweak->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tweaks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tweaks form large-9 medium-8 columns content">
    <?= $this->Form->create($tweak) ?>
    <fieldset>
        <legend><?= __('Edit Tweak') ?></legend>
        <?php
            echo $this->Form->control('vendor');
            echo $this->Form->control('name');
            echo $this->Form->control('protocols');
            echo $this->Form->control('injection_type');
            echo $this->Form->control('payload');
            echo $this->Form->control('note');
            echo $this->Form->control('realms._ids', ['options' => $realms]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
