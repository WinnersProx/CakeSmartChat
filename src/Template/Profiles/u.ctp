<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Profile : '.$userInfos['name']);
?>


<div class="container-customized">
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-4">
          <div id="SideBarTasks" class="clear-fix">
            <?= $this->element('Inc/left_menu');?>
          </div>
        </div>
        <div class="col-md-8">
          <div class="user-card-identity">
            <div class="profile-b">
              <div class="card-header">
                <span class="my-0 font-weight-normal p-intro">User Profile</span>
              </div>
              <?= $this->Html->image($userInfos['avatar'],['class' => 'user-avatar-banner'])?>
            </div>
            <div class="user-profile-name">
              <span class="name"><?= $userInfos['name'] ?></span>&nbsp;
              <span class="email"><?= $userInfos['email'] ?></span>
            </div>
            <div id="user-call-to-action">
              <div class="row">
                <div class="col-md-6">
                  <button type="button" class="btn btn-block btn-outline-primary invite-me">Invite</button>
                </div>
                <div class="col-md-6">
                  <button type="button" class="btn btn-block btn-outline-primary other">View Posts</button>
                </div>
                
              </div>
            </div>
            

          </div>
        </div>
      </div>
      
      
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="fixed-top-menus">
          <div class="user-banner">
          
          <div class="profile-menus">
            <span class="profile-opts" data-exclude="exclude" >
              <a href="/users/edit/<?= $userInfos['id']?>">Edit Profile</a>
            </span>
            <span class="profile-opts">
              <a href="/users/edit/<?= $userInfos['id']?>" data-focus="images">Profile Images</a>
            </span>
            <span class="profile-opts">
              <a href="/users/edit/<?= $userInfos['id']?>" data-focus="posts">Posts</a>
            </span>
            <span class="profile-opts">
              <a href="/users/edit/<?= $userInfos['id']?>" data-focus="friends">Friends</a>
            </span>
            
          </div>
          
        </div>
        </div>
        <div id="main-p">
        <div class="form-group">
          <label for="new-status">New status</label>
          <input type="text" name="status" class="form-control" id="new-status">
          <input type="submit" name="new_status" class="btn btn-outline-success right">
        </div>
        <!--end profile user banner -->
        <div class="user-informations">
          <div class="user-inf-avatars">
            <div class="u-inf-title" id="user-box-images">
              Profile Images
            </div>
            <div class="u-s-avatars">
              <?php 
                $Files = $this->cell('Files');
                $TargetUserInfos = $this->cell('UsersInfo');
                $Files->getUserAvatars($userInfos['id']);

              ?>
            </div>
            
          </div>
          <div class="user-inf-friends">
             <div class="u-inf-title" id="user-box-friends">
                Friends(<?=$TargetUserInfos->countUserFriends($userInfos['id'])?>)
            </div>
            <div class="list-friends">
             <?php
               $TargetUserInfos->getAllUserFriends($userInfos['id']);
              ?>
            </div> 
          </div>
          
        </div>
        
      </div>
      </div>
      
    </div>
    <!--<div class="col-md-2 right-menu">
        <div id="side-p" class="side-one">
           <$this->element('Inc/side_menu');?>
        </div>
    </div>-->
  </div>
</div>
