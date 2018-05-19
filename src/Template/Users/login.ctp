<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'Login-Users');
?>

<div class="row">
    <div class="col-md-6 smartchat-infos">
        <div class="rm-box">Welcome back login and discover what's going on all over the world
        </div>
        <div class="connect-people">
            <div class="people-pictures">
              <?php $this->cell('Files')->getAllpngFiles();?>  
            </div>
        </div>
    </div>
    <div class="myLogonTab col-md-6">
        <div class="col-md-12">
            <div class="panel panel-primary login-box">
                <div class="logon-box">
                    <div class="login-title text-center">
                        Smartchat Login!
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
<?= $this->Html->script('smartcakeAnim',['block' => true]);?>