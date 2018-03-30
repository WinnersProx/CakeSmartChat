<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Profile : '.$userInfos['name']);
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p">
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
              <span class="profile-opts">
                <a href="/users/edit/<?= $userInfos['id']?>">Edit Profile</a>
              </span>
              <span class="profile-opts">
                <a href="/users/edit/<?= $userInfos['id']?>">Profile Images</a>
              </span>
              <span class="profile-opts">
                <a href="/users/edit/<?= $userInfos['id']?>">Posts</a>
              </span>
              <span class="profile-opts">
                <a href="/users/edit/<?= $userInfos['id']?>">Friends</a>
              </span>
              
            </div>
            
          </div>
          <!--end profile user banner -->
          <div class="user-informations">
            <div class="user-inf-avatars">
              <div class="u-inf-title">
                Profile Images
              </div>
              <div class="u-s-avatars">
                <?php 
                  $Files = $this->cell('Files');
                  $Files->getUserAvatars($userInfos['id']);
                ?>
              </div>
              
            </div>
            
          </div>
           

        </div>
    </div>
    <div class="col-md-2 right-menu">
        <div id="side-p">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
</div>
