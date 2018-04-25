<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Share post : '.uniqid($targetPost->id));
    $userInfos = $this->cell('UsersInfo');
    $friendsInfos = $this->cell('UserFriends');
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
      <div id="main-p">
        <span class="community-title">Post Sharing</span>
        Posted by 
        <span class="u-name"><?= $userInfos->getUserInfo($targetPost->post_owner)['name']?></span><br>
        Post Content : 
        <div>
          <?= h($targetPost->content)?>
        </div>
        <div class="text-center">
            <?= $this->Flash->render();?>
          </div>
        <span class="community-title">Post Images</span>
        <?php if(isset($rImgs)):?>
          <div class="post-images">
            <?php foreach($rImgs as $rImg):?>
              <img src="/img/<?= $rImg->img_url?>" class="img-rounded post-images">
            <?php endforeach;?>
          </div>
        <?php endif;?>
        <span class="community-title">Tag friends</span>
        <form action="/posts/new-share/<?= $targetPost->id?>" method="post">
          <div class="tag-friends row">
          <div class="col-md-6">
            <?= $friendsInfos->getUserFriends($LoggedUser['User']['id'])?>
          </div>
          <div class="col-md-6">
            <span class="privacy-setter">Privacy</span>
            <select name="sharePrivacy" class="community-post-privacy">
              <option value="0">Public</option>
              <option value="1">Friends</option>
              <option value="2">Private</option> 
            </select>
          </div>
            
          </div>
          <div class="row">
            <input type="text" name="ShareContent" class="form-control" placeholder="write something about your share" required>
            <div class="col-md-12">

              <br>
              <input type="submit" name="share" value="Share Post" class="btn btn-warning btn-block">
            </div>
          </div>
          
        </form>
        
        
        
        
      </div>
    </div>
    <div class="col-md-2 right-menu">
        <div id="side-p" class="side-one">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
</div>
