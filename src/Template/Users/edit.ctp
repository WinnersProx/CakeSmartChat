<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'Edit Profile');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __($user->name."'s Profile") ?></li>

        <div class="upl-block">
            <div class="avatar-update">
                <?php if ($LoggedUser['User']['avatar']):?>
                    <?= $this->Html->Image($LoggedUser['User']['avatar'], ['class' => 'userAvatar'])?>   
                <?php else: ?>
                    <img src="/img/userdefault.png">
                <?php endif;?>
            </div>
            <div class="upl-button">
                <div class="img-transfer">
                    <form enctype="multipart/form-data" method="post" action="/users/avatar-upload" id="subAvatar">
                        <input type="file" name="userAvatar" class="img-upload avatarSetter" multiple="multiple" required><?= $this->Html->Image('instagram.png', ['class' => 'picture-uploader'])?>
                        <input type="submit" name="s" value="Upload" class="btn btn-xs uploadAvatar">
                    </form>
                    <span class="uploader-text">Click on the icon to upload your profile picture</span>
                    
                </div>
            </div>
            <div class="upload-validate">
               Click here to upload
            </div>
        </div>
        
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user,['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend class="badge-custom"><?= __('Profile Edition') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('phone');
            echo '<i class="fa fa-share fa-rotate-180 "></i> Remember to Upload your avatar for people to recognize you';
            
        ?>
        
    </fieldset>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
