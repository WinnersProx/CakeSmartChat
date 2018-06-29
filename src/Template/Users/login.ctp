<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'Login-Users');
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
            Login
        </div>
        <div class="login-body">
            <?=$this->Form->create($user)?>
            <label for="mail">Email</label>
            <input type="email" name="email" placeholder="Your Email" autocomplete="off" id="mail" required class="login-input">
            <label for="pass">Password</label>
            <input type="Password" name="password" placeholder="Your Password" autocomplete="off" id="pass" required  class="login-input">
            <div class="checkbox" data-remember-user="off">
                <i class="fa fa-toggle-off remember-me"></i> Remember Me
                <input name="remember" type="checkbox" class="input-remember" value="1"> 
            </div>
            <div class="user-called-to-action">
                <button type="submit" value="Sign up" class="btn btn-block btn-action">
                    <i class="fa fa-sign-in"></i> Login
                </button>
                <a href="/users/signup" class="btn btn-block btn-action" ><i class="fa fa-toggle-on"></i> Sign Up</a>
                <a href="" class="btn btn-block btn-action">Login with facebook</a>
            </div>
            
            <?= $this->Form->end()?>
            <div class="user-error">
                <?= $this->Flash->render()?>
            </div>
            
        </div>
        
        
        </div>
    </div>
</div>
