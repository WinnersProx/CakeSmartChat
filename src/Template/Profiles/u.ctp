<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Profile : '.$userInfos['name']);
?>


<div class="container-customized">
  <div class="row">
    <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>

    <div class="col-md-9">
        <div id="myProfile">
          <div class="profile-b">
              <?= $this->Html->image($userInfos['avatar'],['class' => 'user-avatar-banner'])?>
          </div>
          <div id="user-call-to-action">  

            <button type="button" class="btn btn-custom btn-outline-primary invite-me">Invite</button>
          
            <button type="button" class="btn btn-custom btn-outline-primary other">View Posts</button>  

          </div>
          <div id="socialMedias">
            <i class="fa fa-facebook fa-lg"></i>
            <i class="fa fa-google-plus fa-lg"></i>
            <i class="fa fa-instagram fa-lg"></i>
            <i class="fa fa-github fa-lg"></i>

          </div>

        </div>
        <div class="profile-menus" id="pMenus">
              <div class="profile-opts" data-exclude="exclude" >
                <a href="/users/edit/<?= $userInfos['id']?>">Edit Profile</a>
              </div>
              <div class="profile-opts">
                <a href="/users/edit/<?= $userInfos['id']?>" data-focus="images">Profile Images</a>
              </div>
              <div class="profile-opts">
                <a href="/users/edit/<?= $userInfos['id']?>" data-focus="posts">Posts</a>
              </div>
              <div class="profile-opts">
                <a href="/users/edit/<?= $userInfos['id']?>" data-focus="friends">Friends</a>
              </div>

        </div>
        <div  id="main-p">
            
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
       <!-- <div class="form-group">
          <label for="new-status">New status</label>
          <input type="text" name="status" class="form-control" id="new-status">
          <input type="submit" name="new_status" class="btn btn-outline-success right">
        </div>
      -->
  </div>
</div>
