<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tweak[]|\Cake\Collection\CollectionInterface $tweaks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tweak'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tweaks index large-9 medium-8 columns content">
    <h3><?= __('Tweaks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('protocols') ?></th>
                <th scope="col"><?= $this->Paginator->sort('injection_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payload') ?></th>
                <th scope="col"><?= $this->Paginator->sort('note') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tweaks as $tweak): ?>
            <tr>
                <td><?= $this->Number->format($tweak->id) ?></td>
                <td><?= h($tweak->vendor) ?></td>
                <td><?= h($tweak->name) ?></td>
                <td><?= h($tweak->protocols) ?></td>
                <td><?= h($tweak->injection_type) ?></td>
                <td><?= h($tweak->payload) ?></td>
                <td><?= h($tweak->note) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tweak->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tweak->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tweak->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tweak->id)]) ?>
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
