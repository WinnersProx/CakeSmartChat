<?php
/**
  * @var \App\View\AppView $this
  */
    $this->assign('title', 'Edit my Profile');
?>
<div class="row">
    <div class="col-md-3" id="left-side-advices">
    <div class="block-adds-one">
        Thanks <?= $user->name?> For visiting this page
        hence you can update your profile easily!
        <div class="Notify-changes">
            Congratulations you are Almost Done This is the last step!!!
            <br/>
        </div>
    </div>
</div>
<div class="col-md-9">
    <div id="profile-edition" class="row">
    
    <div class="side-nav col-md-4">
        <li class="heading" ><?= __($user->name."'s Profile") ?></li>

        <div class="upl-block">
            <div class="avatar-update">
                 <?= $this->Html->Image($LoggedUser['User']['avatar'], ['class' => 'userAvatar'])?>   
                
            </div>
            <div class="upl-button">
                <div class="img-transfer">
                    <form enctype="multipart/form-data" method="post" action="/users/avatar-upload" id="subAvatar">
                        <input type="file" name="userAvatar" class="img-upload avatarSetter" multiple="multiple" required>
                        <input type="submit" name="s" value="Upload" class="btn btn-xs uploadAvatar">
                    </form>
                    <div class="uploader-text-e">
                        Click on the picture above to upload your profile picture 
                    </div>
                    
                </div>
            </div>
            <div class="upload-validate">
               Click me to upload 
            </div>
        </div>
        
    </div>

<div class="users col-md-8" id="p-edit">
    <?= $this->Form->create($user,['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend class="badge-custom"><?= __('Profile Edition') ?></legend>
        <div class="first-edit-block">
            <?php
                echo $this->Form->control('name');
                echo $this->Form->control('email');
                echo $this->Form->control('password');
                echo $this->Form->control('phone');
                echo '<i class="fa fa-share fa-rotate-180 "></i> Remember to Upload your avatar for people to recognize you';
            ?>
        </div>
        <div class="last-edit-block">
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dateOfB">Date of Birth</label>
                    <input type="date" name="user_dob"  id="dateOfB">
                </div>
            </div>
            <div class="col-md-6">
                <div class="user-gender">
                    Your gender
                    <select class="user_sex">
                        <option value="M">Man</option>
                        <option value="W">Woman</option>
                    </select>
                </div>
                
            </div>
                
            <?php
                echo $this->Form->control('about');
            ?>

           <div class="submit-btn-edit">
                <?= $this->Form->button(__('Update Now'),['class' => 'btn btn-success submit-b edit-b']) ?>
                <?= $this->Form->end() ?>  
            </div> 
        </div>
        
        
    </fieldset>
    <div class="btn-control-custom" id="prev">
        <i class="fa fa-arrow-circle-o-left"></i> <a class="">Prev</a>
    </div>
    <div class="btn-control-custom  right-s" id="next">
        <a class="">Next</a> <i class="fa fa-arrow-circle-o-right"></i>
    </div>
    
</div>

    
</div>

</div>
    
</div>

