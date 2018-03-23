<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'Login-Users');
?>
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('Sign Up'), ['action' => 'signup']) ?></li>
        </ul>
    </nav>

<div class="users form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-4 col-md-offset-3 login-box">
            <div class="panel panel-primary">
                <span class="flash"><?= $this->Flash->render()?></span>
                <div class="panel-footer">
                    <h2 class="panel-title text-center login-title"><strong>Login to WinChat!</strong></h3>
                </div>
                <div class="panel-body login-bd">
                    <?= $this->Form->create()?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('email',['placeholder' => 'yourmail@gmail.com','required'])?>
                        </div>
                        <div class="form-group">
                            <?=$this->Form->control('password', ['placeholder' => 'Password','required'])?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                            </label>
                        </div><br>
                        <?= $this->Form->button(__('Login'), ['class' => 'btn btn-primary btn-block'])?>
                    </fieldset>
                    <?= $this->Form->end() ?>
                    <input class="btn btn-lg btn-facebook btn-block" type="submit" value="Login via facebook">
                </div>
            </div>
        </div>
    </div>
</div>
