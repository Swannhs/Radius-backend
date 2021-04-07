<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TweakRealm $tweakRealm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tweak Realms'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tweaks'), ['controller' => 'Tweaks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tweak'), ['controller' => 'Tweaks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tweakRealms form large-9 medium-8 columns content">
    <?= $this->Form->create($tweakRealm) ?>
    <fieldset>
        <legend><?= __('Add Tweak Realm') ?></legend>
        <?php
            echo $this->Form->control('tweak_id', ['options' => $tweaks]);
            echo $this->Form->control('realm_id', ['options' => $realms]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
