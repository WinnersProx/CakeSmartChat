<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'SignUp-Users');
?>

<div class="row myUsersSignUp">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend class="badge-custom"><?= __('Sign Up!') ?></legend>
        <div class="col-md-4 col-xs-4 Sign-Avatar">
            <div class="avatar-origin">
                <img src="/img/avatars/userdefault.png" class="img-circle s-avatar">
            </div>
            <div class="S-instructions">
                Don't think  too much on this you can upload your avatar now or later!
            </div>
        </div>
        <div class="col-md-7 SignUp-Cred">
            <?php
                echo $this->Form->control('name',['placeholder' => 'Your name']);
                echo $this->Form->control('email',['placeholder' => 'Your email']);
                echo $this->Form->control('password',['placeholder' => 'Your password']);
                echo $this->Form->control('phone',['placeholder' => 'Your phone number']);
                echo $this->Form->control('about', ['placeholder' => 'All about me!', 'style'=> 'resize:none','rows' => '2']);

            ?>
            <?= $this->Form->submit(__('Sign Up'),['class' => 'btn btn-custom sign-custom-btn right']) ?>
            <?= $this->Form->end() ?>
        </div>
        
    </fieldset>
    
</div>

