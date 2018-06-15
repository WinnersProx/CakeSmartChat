<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Profile : '.$userInfos['name']);
    $cell = $this->cell('Posts');
    
?>
<!-- $this->Html->css("emojionearea", ["block" => true]);?>-->

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
      <div class="MainProfileMenus" ng-app="Profiles" data-us-infos="<?= $userInfos['id']?>" ng-controller="ProfilesController">
        <div class="profile-menus" id="pMenus">
            <div class="profile-opts">
              <a href="#!/" data-focus="posts">Home</a>
            </div>

            <div class="profile-opts">
              <a href="#!/pictures" data-focus="images">Pictures</a>
            </div>
            <div class="profile-opts">
              <a href="#!/friends" data-focus="friends">Friends</a>
            </div>
            <div class="profile-opts" data-exclude="exclude" >
              <a href="/users/edit/<?= $userInfos['id']?>">Edit Profile</a>
            </div>

        </div>
        <div  id="profileRessources">
          <div style="text-align: center;">
            <?= $this->Flash->render();?>
          </div>
        
          <div class="user-informations">
            <div ng-view>
              <!--data displayed here -->
            </div>
            
          </div>
          
        </div>
      </div>
      
    </div>
    
       
  </div>
</div>

<script>
  
  var $profileApp = angular.module('Profiles', ['ngRoute']);

  $profileApp.config(($routeProvider) => {
    $routeProvider
    .when('/', {
      templateUrl : "/profiles/home"
    }, function(success){
      alert("Done successfully");
    })
    .when('/friends', {
      templateUrl : "/profiles/friends"
      //controller  : "ProfilesController"
    })
    .when('/edition', {
      templateUrl : "/users/edit"
      //controller  : "ProfilesController"
    })
    .when('/pictures', {
      templateUrl : "/profiles/pictures"
      //controller  : "ProfilesController"
    })


  });
  $profileApp.controller('ProfilesController', function($scope){
    $scope.scrollTo = () => {
      $('#scroller').click(function(){
        alert("clicked");
      })
    }
  })
  
</script>
<!---->