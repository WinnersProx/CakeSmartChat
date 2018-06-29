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
    $usersDetails = $this->cell('UserFriends');

?>



<div class="container-customized">
  <div class="row">
    <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
      <div  id="main-p">
        <span class="community-title">Share Community Post</span>
        <div class="render">
          <?= $this->Flash->render()?>
        </div>
        <div class="community-posts">
          <form action="/CommunityPosts/newPostShare/<?= $postToShare->id ?>" method="post" enctype="multipart/form-data">
            
            <div class="row">

              <div class="col-md-12">
                  
                  Creater : <span class="u-name"><?= $CommunityCell->getMemberInfos($postToShare->member_poster)['name']?></span><br> 
                  Content : <?= h($postToShare->post_content)?>
                  <div class="form-group">
                    <textarea class="form-control" name="sharePostContent" rows="2" placeholder="Write something about this or not!!!"></textarea>
                  </div>
                  <div class="pictures">
                      <?php if(isset($postToShare->community_pictures)):?>
                          <?php foreach($rPictures as $picture):?>
                              <img src="/img/<?= $picture['picture_url']?>" class="post-images">
                          <?php endforeach;?>
                      <?php endif;?>
                    
                  </div>
                  <span>Tag friends : </span><br>
                  <?php $usersDetails->getUserFriends($LoggedUser['User']['id']);?>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                
                  <span class="privacy-setter">Privacy</span>
                    <select name="sharePrivacy" class="community-post-privacy">
                      <option value="0">Public</option>
                      <option value="1">Friends</option>
                      <option value="2">Private</option> 
                    </select>

                  <div class="bottom-button">
                    <button type="submit" name="community-post-submit" class="btn btn-primary btn-block">
                      <i class="fa fa-edit fa-lg"></i> Share This Post
                    </button>
                    
                  </div>
                  
              </div>
            </div>
            </form>   
          </div>
          
        </div>
      </div>
    <div class="col-md-2" id="community-side-m">
        <div id="side-p" class="side-one">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
    
  </div>
</div>