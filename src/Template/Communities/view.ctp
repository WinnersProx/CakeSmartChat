<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Community $community
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Community'), ['action' => 'edit', $community->community_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Community'), ['action' => 'delete', $community->community_id], ['confirm' => __('Are you sure you want to delete # {0}?', $community->community_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Communities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Community'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Communities'), ['controller' => 'Communities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Community'), ['controller' => 'Communities', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="communities view large-9 medium-8 columns content">
    <h3><?= h($community->community_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Community') ?></th>
            <td><?= $community->has('community') ? $this->Html->link($community->community->community_id, ['controller' => 'Communities', 'action' => 'view', $community->community->community_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $community->has('user') ? $this->Html->link($community->user->id, ['controller' => 'Users', 'action' => 'view', $community->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Community Name') ?></th>
            <td><?= h($community->community_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Time') ?></th>
            <td><?= h($community->created_time) ?></td>
        </tr>
    </table>
</div>
