<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $communityMember->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $communityMember->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Community Members'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="communityMembers form large-9 medium-8 columns content">
    <?= $this->Form->create($communityMember) ?>
    <fieldset>
        <legend><?= __('Edit Community Member') ?></legend>
        <?php
            echo $this->Form->control('id_community');
            echo $this->Form->control('member_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('member_role');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
