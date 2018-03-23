<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'SignUp-Users');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Menus') ?></li>
        <li><?= $this->Html->link(__('Login'), ['action' => 'login']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend class="badge"><?= __('Sign Up!') ?></legend>
        <div class="col-md-5 avatar" id="uploader">
            <strong>Set Up your Profile Image <i>Later</i> or <i>Now!</i></strong>
            <img src="../img/avatarpic.png" title="Browse It!">
            
        </div>
        <div class="col-md-7">
            <?php
                echo $this->Form->control('name');
                echo $this->Form->control('email');
                echo $this->Form->control('password');
                echo $this->Form->control('phone');
                echo $this->Form->control('about', ['placeholder' => 'All about me!', 'style'=> 'resize:none','rows' => '2']);

            ?>
            <?= $this->Form->submit(__('Sign Up'),['class' => 'btn btn-success right']) ?>
            <?= $this->Form->end() ?>
        </div>
        
    </fieldset>
    
</div>
