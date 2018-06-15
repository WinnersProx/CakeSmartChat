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
                    <?=$this->Html->image("smartchat_desktop2.png", ["title" =>"mobile version", "id" => "desktop_image", "class" => " animated infinite fadeIn"])?>
                    
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
                    <?=$this->Html->image("smartchat_mobile2.png", ["title" => "mobile-version", "id" => "mobile_image", "class" => "animated infinite fadeIn"])?>
                    
                </div>
                <span>
                    <i class="fa fa-circle"></i>
                </span>
                
            </div>
        </div>
    </div>
    <div class="myLogonTab col-md-6">
        <div class="col-md-12">
            <div class="panel panel-primary login-box">
                <div class="logon-box">
                    <div class="login-title text-center">
                        <?= __("Smartchat Login!")?>
                    </div>
                </div>
               
                <?php if($this->request->referer() != null):?>
                    <span class="flash l-flash"><?= $this->Flash->render()?></span>
                <?php endif;?>
                <div id="imgHome">
                    <?= $this->Html->image('Bootsnback.jpg', ['class' => 'userLogonHome']);?>
                </div>
                <div class="panel-body login-bd">
                    <?= $this->Form->create()?>

                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('email',['placeholder' => 'yourmail@gmail.com','required','class'])?>
                        </div>
                        <div class="form-group">
                            <?=$this->Form->control('password', ['placeholder' => 'Password','required','class'])?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                            </label>
                        </div><br>
                        <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary btn-block'])?>
                    </fieldset>
                    <?= $this->Form->end() ?>
                    <input class="btn btn-lg btn-facebook btn-block" type="submit" value="Login via facebook" id="fb-connect">
                </div>
            </div>
        </div>
    </div>
</div>
