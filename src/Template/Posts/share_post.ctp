<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Share post : '.uniqid($targetPost->id));
    $userInfos = $this->cell('UsersInfo');
    $friendsInfos = $this->cell('UserFriends');
    $postCell = $this->cell('Posts');
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
      <div id="main-p">
        <span class="community-title">Share <?= $userInfos->getUserInfo($targetPost->post_owner)['name'] ?>'s Post</span>
        <div id="sharePostOptions">
          <div class="text-center">
            <?= $this->Flash->render();?>
          </div>
          <div class="share-post-content">
            <?= h($targetPost->content)?>
          </div>
          <div class="post-images">
            <?= $postCell->postImages($targetPost->id) ?>
          </div>
          <!--for sharing -->
          <form action="/posts/new-share/<?= $targetPost->id?>" method="post">
              <div class="tag-friends row">
              <div class="col-md-6">
                <span class="community-title">Tag Friends</span>
                <div class="fr-tags">
                  <?= $friendsInfos->getUserFriends($LoggedUser['User']['id'])?>
                </div>
                <?= $this->Form->unlockField('upload_image'); ?>
              </div>
              <div class="col-md-6">
                <span class="community-title">Share Privacy</span>
                <span class="privacy-setter">Privacy</span>
                <select name="sharePrivacy" class="community-post-privacy">
                  <option value="0">Public</option>
                  <option value="1">Friends</option>
                  <option value="2">Private</option> 
                </select>
              </div>
                
              </div>
              <input type="text" name="ShareContent" class="form-control" placeholder="write something about your share" required>
              <div class="row">
                  <input type="submit" name="share" value="Share Post" class="btn btn-default btn-block shareSub">
              </div>
          </form>
          <!--sharing interface -->
          
      </div>
        
        
      </div>
    </div>
    <div class="col-md-2 right-menu">
        <div id="side-p" class="side-one">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
</div>
