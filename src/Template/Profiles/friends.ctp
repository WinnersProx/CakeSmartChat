 <!--case friends -->
 <?php
 $TargetUserInfos = $this->cell('UsersInfo');
 ?>
<div class="user-inf-friends custom-animation slideInRight">
  <!--<div class="u-inf-title" id="user-box-friends">
      Friends(<=$TargetUserInfos->countUserFriends($userInfos['id'])?>)
  </div>-->
  <div class="list-friends">
   <?php
     $TargetUserInfos->getAllUserFriends($userInfos['id']);
    ?>
  </div> 
</div>
<!--end case friends -->