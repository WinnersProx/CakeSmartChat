<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'SignUp-Users');
?>
<div class="row">
    <div class="col-md-6" id="smartchat-templates">
        
        <div class="connect-people">
            <div class="smartchat-desktop">
                <div class="desktop-toolbar">
                    <span class="camera-desk"><i class="fa fa-dot-circle-o"></i></span>
                </div>
                <div class="desktop-contents">
                   <div style="background-image:url('/img/smartchat_desktop2.png')" id="desktop_image">
                        
                    </div>
                    
                    <div class="desktop_bottom-bar">
                        <span class="camera-desk">
                            <i class="fa fa-power-off"></i>
                        </span>
                    </div>
                    
                </div>
                
                <div class="desktop-cane"></div>
            </div>
            <div class="smartchat-mobile">
                <div class="mobile-toolbar">
                    <span class="speaker"></span>
                    <span class="camera">
                        <i class="fa fa-dot-circle-o"></i>
                    </span>
                </div>
                <div class="mobile-contents">
                    <div class="contents-top-bar">
                        <time class="time" id="time">---</time>
                    </div>
                    <div id="mobile_image" title="mobile mobile-version" style="background-image:url('/img/smartchat_mobile2.png')">
                    </div>
                    
                </div>
                <span>
                    <i class="fa fa-circle"></i>
                </span>
                
            </div>
        </div>
    </div>
    <div class="myLogonTab col-md-6">
        <div class="signupbox animated bounce">
        <div class="own-design">
            Sign Up
        </div>
        <?=$this->Form->create()?>
            <label for="name">Username</label>
            <input type="text" name="name" placeholder="Username" autocomplete="off" id="name" required>

            <label for="mail">Email</label>
            <input type="email" name="email" placeholder="Your Email" autocomplete="off" id="mail" required>
            <div class="invalid-feedback" style="width: 100%;">
                  Your mail required.
            </div>
            <label for="phone">Telephone</label>
            <input type="text" name="phone" placeholder="Your phone number" autocomplete="off" id="phone" required>
            <label for="pass">Password</label>
            <input type="Password" name="password" placeholder="Your Password" autocomplete="off" id="pass" required>
            <div class="user-called-to-action">
                <button type="submit" value="Sign up" class="btn btn-block btn-action">
                    <i class="fa fa-sign-in"></i> Sign Up
                </button>
                <a href="/users/login" class="btn btn-block btn-action" ><i class="fa fa-toggle-on"></i> Login</a> 
            </div>
            
        <?= $this->Form->end()?>
        <div class="user-error">
            <?= $this->Flash->render()?>
        </div>
        
</div>
    </div>
    
</div>

<!--<div class="row myUsersSignUp">
    
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
                
            </div>
            </div>
            

            <?=$this->Form->control('password',['placeholder' => 'Your password']);?>
            <?= $this->Form->control('phone',['placeholder' => 'Your phone number']);?>
            <?= $this->Form->control('about', ['placeholder' => 'All about me!', 'style'=> 'resize:none','rows' => '2']);?>
            <?= $this->Form->submit(__('Sign Up'),['class' => 'btn btn-custom sign-custom-btn right']) ?>
            <?= $this->Form->end() ?>
        </fieldset>
    </div>

    
</div>-->

