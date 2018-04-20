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
    $this->assign('title', 'Share Community Post : ' . $postToShare->member_poster);
    $CommunityCell = $this->cell('Communities');
    $cInfos = $CommunityCell->getCommunityInfos($postToShare->target_community);
    $rPictures = $CommunityCell->getPostRelatedPictures($postToShare->id)
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

                <?= $CommunityCell->generateCommunityIcons($cInfos['id'])?>

            </div>
            <div class="col-md-8">
            <div id="comm-text">
                
                Welcome to <?= $postToShare->target_community ?> Community!!!
                
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
        
        <div class="community-posts row">
          <form action="/communities/newPost/<?=$postToShare->target_community?>" method="post" enctype="multipart/form-data">
            
            <div class="row">
              <div class="col-md-12">
                  <span class="community-title">Share Post</span>
                  Creater : <span class="u-name"><?= $CommunityCell->getMemberInfos($postToShare->member_poster)['name']?></span><br> 
                  Content : <?= h($postToShare->post_content)?>
                  <div class="pictures">
                      <?php if($rPictures->count() > 0):?>
                          <?php foreach($rPictures->fetchAll('obj') as $picture):?>
                              <img src="/img/<?= $picture->picture_url?>" class="post-images">
                          <?php endforeach;?>
                      <?php endif;?>
                    
                  </div>
              </div>
              <div class="col-md-8">
                
                  <span class="privacy-setter">Privacy</span>
                    <select name="post-privacy" class="community-post-privacy">
                      <option value="0">Public</option>
                      <option value="1">Members</option>
                      <option value="2">Private</option> 
                    </select>
                  
              </div>
              <div class="col-md-4">
                <div class="bottom-button right">
                  <input type="submit" name="community-post-submit" class="btn btn-primary community-post-submit" value="Share">
                </div>
                
              </div> 
              </div>
               
            </div>
          </form>
        </div>
        <div class="render">
          <?= $this->Flash->render()?>
        </div>
        <div class="community-posts-lists">
            
        </div>
        <span class="community-title">Members</span>
        
         <div class="box-members">
            
            

         </div>
        </div>
    </div>
    <div class="col-md-2" id="community-side-m">
        <div id="side-p" class="side-one">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
    
</div>

