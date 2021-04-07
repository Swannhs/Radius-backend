<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tweak $tweak
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tweak'), ['action' => 'edit', $tweak->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tweak'), ['action' => 'delete', $tweak->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tweak->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tweaks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tweak'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Realms'), ['controller' => 'Realms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Realm'), ['controller' => 'Realms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tweaks view large-9 medium-8 columns content">
    <h3><?= h($tweak->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Vendor') ?></th>
            <td><?= h($tweak->vendor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($tweak->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Protocols') ?></th>
            <td><?= h($tweak->protocols) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Injection Type') ?></th>
            <td><?= h($tweak->injection_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payload') ?></th>
            <td><?= h($tweak->payload) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Note') ?></th>
            <td><?= h($tweak->note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($tweak->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Realms') ?></h4>
        <?php if (!empty($tweak->realms)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Available To Siblings') ?></th>
                <th scope="col"><?= __('Icon File Name') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Fax') ?></th>
                <th scope="col"><?= __('Cell') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Street No') ?></th>
                <th scope="col"><?= __('Street') ?></th>
                <th scope="col"><?= __('Town Suburb') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Country') ?></th>
                <th scope="col"><?= __('Lat') ?></th>
                <th scope="col"><?= __('Lon') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Twitter') ?></th>
                <th scope="col"><?= __('Facebook') ?></th>
                <th scope="col"><?= __('Youtube') ?></th>
                <th scope="col"><?= __('Google Plus') ?></th>
                <th scope="col"><?= __('Linkedin') ?></th>
                <th scope="col"><?= __('T C Title') ?></th>
                <th scope="col"><?= __('T C Content') ?></th>
                <th scope="col"><?= __('Suffix') ?></th>
                <th scope="col"><?= __('Suffix Permanent Users') ?></th>
                <th scope="col"><?= __('Suffix Vouchers') ?></th>
                <th scope="col"><?= __('Suffix Devices') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($tweak->realms as $realms): ?>
            <tr>
                <td><?= h($realms->id) ?></td>
                <td><?= h($realms->name) ?></td>
                <td><?= h($realms->available_to_siblings) ?></td>
                <td><?= h($realms->icon_file_name) ?></td>
                <td><?= h($realms->phone) ?></td>
                <td><?= h($realms->fax) ?></td>
                <td><?= h($realms->cell) ?></td>
                <td><?= h($realms->email) ?></td>
                <td><?= h($realms->url) ?></td>
                <td><?= h($realms->street_no) ?></td>
                <td><?= h($realms->street) ?></td>
                <td><?= h($realms->town_suburb) ?></td>
                <td><?= h($realms->city) ?></td>
                <td><?= h($realms->country) ?></td>
                <td><?= h($realms->lat) ?></td>
                <td><?= h($realms->lon) ?></td>
                <td><?= h($realms->user_id) ?></td>
                <td><?= h($realms->created) ?></td>
                <td><?= h($realms->modified) ?></td>
                <td><?= h($realms->twitter) ?></td>
                <td><?= h($realms->facebook) ?></td>
                <td><?= h($realms->youtube) ?></td>
                <td><?= h($realms->google_plus) ?></td>
                <td><?= h($realms->linkedin) ?></td>
                <td><?= h($realms->t_c_title) ?></td>
                <td><?= h($realms->t_c_content) ?></td>
                <td><?= h($realms->suffix) ?></td>
                <td><?= h($realms->suffix_permanent_users) ?></td>
                <td><?= h($realms->suffix_vouchers) ?></td>
                <td><?= h($realms->suffix_devices) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Realms', 'action' => 'view', $realms->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Realms', 'action' => 'edit', $realms->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Realms', 'action' => 'delete', $realms->id], ['confirm' => __('Are you sure you want to delete # {0}?', $realms->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
