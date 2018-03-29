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
          <div class="user-informations">
            <div class="user-inf-avatars">
              <span class="u-inf-title">
                Profile Images
              </span>
            </div>
            Profile <?=$userInfos['name']?>
           <?= $this->Html->link('Edit Profile', ['controller' => 'Users', 'action' => 'edit',$userInfos['id']])?>
           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
           cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
           proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
           cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
           proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
           cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
           proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
           consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
           cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
           proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>
           

        </div>
    </div>
    <div class="col-md-2 right-menu">
        <div id="side-p">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
</div>
