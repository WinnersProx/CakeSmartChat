<!--case home -->
<?php
$cell = $this->cell('Posts');
$TargetUserInfos = $this->cell('usersInfo');
?>
<div class="custom-animation slideInRight">
  <div class="user-status-post">
    <form method="post" action="/timelines/new_timeline/<?= $userInfos['id']?>" enctype="multipart/form-data">

      <div class="form-group" id="userTmlns">
        <div class="row">
          <div class="col-md-12 col-xs-8">
            
             <textarea class="form-control myStatus" placeholder="Write on <?= $userInfos['name']?>'s Profile" name="statusContent" rows="1" required></textarea>
            <div class="bottom-menu">
              <div id="container">
                
              </div>
              <!--developped in case of communities -->
              <div class="img-transfer profile-transfer">
                <input type="file" name="statusImg" class="img-upload">
                <span class="post-img-baker custom-img-baker">
                      <i class="fa fa-upload"></i> Image
                </span>
              </div>
              <div class="right">
                <button type="submit" name="new" class="btn btn-default btn-customized"><i class="fa fa-edit fa-lg"></i> New Post</button>
              </div>
              
            </div>
           
          </div>
        </div>
        
      </div>
      
    </form>
  </div>
  <div class="home-timelines">
    <?php foreach ($timelines as $tmn): ?>
      <?php $img = $cell->timelineImages($tmn->id);?>
      <?php if($tmn->target_id == $userInfos['id']):?>
        <div class="row">
          <div class="col-md-7 col-xs-4">
            <div class="timeline-contents">
            <span><?=$this->Html->image($TargetUserInfos->getUserInfo($tmn->poster_id)['avatar'], ['class' => "user-avatar-md"]) ?> </span>
            <span class="u-name">
              <?=$TargetUserInfos->getUserInfo($tmn->poster_id)['name'];?>
            </span> posted
            <?= $tmn->contents ?>
            
            <div class="timeline-imgs">

              <?= $this->Html->image($img['img_url'], ['class' => "img-responsive"]) ?>

            </div>
            <div class="bottom-tmn-menus">
                <span>
                    <span class="btn btn-sm btn-customized-sm btn-outline-success star-tmn" data-star-tmn="tmn-<?=$tmn->id?>" data-object="star" ng-click="starTimeline(name)" #name>
                    <i class="fa fa-star"></i> Star
                  </span>
                </span>
                <span>
                  <span class="btn btn-sm btn-customized-sm btn-outline-success">
                    <i class="fa fa-comment"></i> Comment</span>
                </span>
            </div>
          </div>
          </div>
          <div class="col-md-5 col-xs-3 timeline-comments">
            <div class="u-name count-comments-by-tmn">
              Comments
            </div>
            <div class="count-stars-bytmn">
              Actually <span class="count-tmn-stars"> <?= $cell->getNumberOfStars($tmn->id)?></span> Stars 
              
            </div>
            <span>No comment right now please</span>

            <input type="text" name="commentTimeln" class="form-control custom-input commentTmln" placeholder="comment this timeline" data-related-tmn="<?= $tmn->id ?>" ng-keypress="commentTimeline($event)" ng-blur="commentBlured($event)">
          </div>
        </div>
    <?php endif;?>
    <?php endforeach ?>
  </div>
</div>

<!--case home -->