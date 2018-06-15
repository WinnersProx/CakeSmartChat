<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'SignUp-Users');
?>

<div class="row myUsersSignUp">
    
    <div class="col-md-4 col-xs-2 Sign-Avatar">
        <div class="avatar-origin">
            <img src="/img/avatars/userdefault.png" class="img-circle s-avatar">
        </div>
        <div class="S-instructions">
            Don't think  too much on this you can upload your avatar now or later!
        </div>
    </div>
    <div class="col-md-8  SignUp-Cred">
        <legend class="badge-custom"><?= __('Sign Up!') ?></legend>
        <fieldset>
            <?= $this->Form->create($user) ?>
            <?= $this->Form->control('name',['placeholder' => 'Your name']);?>
            <div class="mb-3">
              <label for="username">Email</label> 
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="email" placeholder="your email" required name="email">
                <div class="invalid-feedback" style="width: 100%;">
                  Your mail required.
                </div>
            </div>
            </div>
            

            <?=$this->Form->control('password',['placeholder' => 'Your password']);?>
            <?= $this->Form->control('phone',['placeholder' => 'Your phone number']);?>
            <?= $this->Form->control('about', ['placeholder' => 'All about me!', 'style'=> 'resize:none','rows' => '2']);?>
            <?= $this->Form->submit(__('Sign Up'),['class' => 'btn btn-custom sign-custom-btn right']) ?>
            <?= $this->Form->end() ?>
        </fieldset>
    </div>

    
</div>

