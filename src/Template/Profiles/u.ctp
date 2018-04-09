<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Profile : '.$userInfos['name']);
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
      <div id="main-p">
        <div class="user-banner">
          <div class="profile-user-banner">
            <?= $this->Html->image($userInfos['avatar'],['class' => 'user-avatar-banner'])?>
          </div>
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
    <div class="col-md-2 right-menu">
        <div id="side-p" class="side-one">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
</div>
