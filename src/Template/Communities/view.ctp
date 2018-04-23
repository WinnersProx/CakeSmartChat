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
        <span class="community-title">Bake Posts</span>
        <div class="community-posts row">
          <form action="/communities/newPost/<?=$targetCommunity->community_name?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <textarea class="form-control new-community-post" name="community-post-content" placeholder="New Post in <?= $targetCommunity->community_name ?> community " required></textarea>
            </div>
            <div class="row">
              <div class="col-md-8">
                <div class="post-pictures">
                  <input type="file" name="post-pictures[]" class="picture-baker" value="Add Pictures" multiple="multiple">
                  <span class="community-file-options">
                    <span class="post-img-baker">
                    <i class="fa fa-upload"></i> Upload
                    </span>
                    &nbsp;<span class="adds-text">Add images</span>
                  </span>
                  <span class="privacy-setter">Privacy</span>
                    <select name="post-privacy" class="community-post-privacy">
                      <option value="0">Public</option>
                      <option value="1">Members</option>
                      <option value="2">Private</option> 
                    </select>
                  
                </div>
              </div>
              <div class="col-md-4">
                <div class="bottom-button right">
                  <input type="submit" name="community-post-submit" class="btn btn-primary community-post-submit" value="New Post">
                </div>
                
              </div>  
            </div>
          </form>
        </div>
        <div class="render">
          <?= $this->Flash->render()?>
        </div>
        <div class="community-posts-lists">
            <?php
                $CommunityCell->getCommunityPosts($targetCommunity->id);
            ?>
        </div>
        <span class="community-title">Members</span>
        
         <div class="box-members">
             <?php
                $userInfos = $this->cell('UsersInfo'); 
                $userMembers = $CommunityCell->listCommunityMembers($targetCommunity->id);
                
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

