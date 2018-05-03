<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'Login-Users');
?>
<!--  <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('Sign Up'), ['action' => 'signup']) ?></li>
        </ul>
    </nav>-->

<div class="row">
    <div class="col-md-6 smartchat-infos visible-md">
        <div class="rm-box">Welcome back login and discover what's going on all over the world
        </div>
        <div class="connect-people">
            <div class="people-pictures">
              <?php $this->cell('Files')->getAllpngFiles();?>  
            </div>
        </div>
    </div>
    <div class="myLogonTab col-md-6">
        <div class="col-md-4 login-box">
            <div class="panel panel-primary">
                <div class="logon-box">
                    <span class="login-title text-center">Smartchat Login!</span>
                </div>
               
                <?php if($this->request->referer() != null):?>
                    <span class="flash l-flash"><?= $this->Flash->render()?></span>
                <?php endif;?>
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
<?= $this->Html->script('smartcakeAnim',['block' => true]);?>