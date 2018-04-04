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
                ['action' => 'delete', $community->community_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $community->community_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Communities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Communities'), ['controller' => 'Communities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Community'), ['controller' => 'Communities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="communities form large-9 medium-8 columns content">
    <?= $this->Form->create($community) ?>
    <fieldset>
        <legend><?= __('Edit Community') ?></legend>
        <?php
            echo $this->Form->control('creater_id', ['options' => $users]);
            echo $this->Form->control('community_name');
            echo $this->Form->control('created_time', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
