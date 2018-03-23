<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User $user
  */
    $this->assign('title', 'Profile-Users');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>

<div class="users view large-9 medium-8 columns content">
    <div class="row">
       <div class="col-md-7 ">
       <div class="panel panel-default">
            <div class="panel-header"> 
                 <h4 >User Profile<?= h($user->id)?></h4>
            </div>
            <div class="panel-body">  
                <div class="box box-info">
                    <div class="box-body">
                        <div class="col-sm-6">
                            <div  align="center"> 
                                <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> 
                                 <input id="profile-image-upload" class="hidden" type="file">
                                 <div style="color:#999;" >click here to change profile image</div>
                                <!--Upload Image Js And Css-->
               
                            </div>
                            <br>
                            <!-- /input-group -->
                        </div>
                        <div class="col-sm-6">
                            <h4 style="color:#00b1b1;"><?= h($user->name) ?></h4></span>        
                        </div>
                    <div class="clearfix"></div>
                    <hr style="margin:5px 0 5px 0;">
                    <div class="col-sm-5 col-xs-6 tital " >First Name:</div>
                    <div class="col-sm-7 col-xs-6 "><?= h($user->name)?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Created:</div>
                    <div class="col-sm-7"><?= h($user->created)?></div>

                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Modified:</div>
                    <div class="col-sm-7"><?= h($user->modified)?></div>

                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Email</div>
                    <div class="col-sm-7"><?= h($user->email)?></div>

                    <div class="clearfix"></div>
                    <div class="bot-border"></div>
                    <div class="col-sm-5 col-xs-6 tital " >About:</div>
                    <div class="col-sm-7"><?= h($user->about)?></div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Phone Number:</div>
                    <div class="col-sm-7"><?= h($user->phone) ?></div>
 <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div> 
    </div> 
</div>
</div>  
<script>
    $(function() {
        $('#profile-image1').on('click', function() {
            $('#profile-image-upload').click();
        });
    });       
 </script> 
       
       
       
       
       
       
       
       
       
   </div>
</div>






