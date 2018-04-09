<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\CommunityMember $communityMember
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Community Member'), ['action' => 'edit', $communityMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Community Member'), ['action' => 'delete', $communityMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $communityMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Community Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Community Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="communityMembers view large-9 medium-8 columns content">
    <h3><?= h($communityMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $communityMember->has('user') ? $this->Html->link($communityMember->user->id, ['controller' => 'Users', 'action' => 'view', $communityMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member Role') ?></th>
            <td><?= h($communityMember->member_role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($communityMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Community') ?></th>
            <td><?= $this->Number->format($communityMember->id_community) ?></td>
        </tr>
    </table>
</div>
