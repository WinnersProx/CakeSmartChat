<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Message $message
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Message'), ['action' => 'edit', $message->m_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Message'), ['action' => 'delete', $message->m_id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->m_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messages view large-9 medium-8 columns content">
    <h3><?= h($message->m_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('M Content') ?></th>
            <td><?= h($message->m_content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Id') ?></th>
            <td><?= $this->Number->format($message->m_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Sender') ?></th>
            <td><?= $this->Number->format($message->m_sender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Receiver') ?></th>
            <td><?= $this->Number->format($message->m_receiver) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('M Created') ?></th>
            <td><?= h($message->m_created) ?></td>
        </tr>
    </table>
</div>
