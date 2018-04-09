<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Community[]|\Cake\Collection\CollectionInterface $communities
  */
?>
<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'View ' . $targetCommunity->community_name);
    $CommunityCell = $this->cell('Communities');
    $countMembers = $CommunityCell->countMembers($targetCommunity->id);

?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
        <div  id="main-p">
        <div class="community-banner">
        <div class="row">
            <div class="col-md-4" id="community-image">

                <?= $CommunityCell->generateCommunityIcons($targetCommunity->id)?>

            </div>
            <div class="col-md-8">
            <div id="comm-text">
                
                Welcome to <?= $targetCommunity->community_name ?> Community!!!
                <?php if(!$CommunityCell->checkCommunityMembership($targetCommunity->id)):?>
                  <span class="custom-button"><a href="/communities/joinCommunity/<?= $targetCommunity->id ?>">Join</a></span>
                <?php endif;?>
            </div>
            <div class="comm-menus">
               <span class="profile-opts">
                   <a href="">Posts</a>
               </span> 
                <span class="profile-opts">
                   <a href="">Settings</a>
               </span> 
                <span class="profile-opts">
                   <a href="">Images</a>
               </span>
               <span class="profile-opts">
                   <a href="">Members</a>
               </span>  
            </div>
                
            </div>
        </div>
             
        </div>
        <span class="community-title">Members</span>
        <div class="render">
          <?= $this->Flash->render()?>
        </div>
         <div class="box-members">
             <?php
                $userInfos = $this->cell('UsersInfo'); 
                $userMembers = $CommunityCell->listMembers($targetCommunity->id);
                
             ?>
            

         </div>
        </div>
    </div>
    <div class="col-md-2" id="community-side-m">
        <div id="side-p" class="side-one">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
    
</div>

