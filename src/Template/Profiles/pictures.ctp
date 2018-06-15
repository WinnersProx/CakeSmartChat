<!--case albums -->
<?php
  $Files = $this->cell('Files');
?>
<div class="user-pictures-galeries custom-animation slideInRight">
  <div class="album py-5">
    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <?php
              $user_avatars = $Files->generateGalleryCover('img/avatars/'.$userInfos['id']);
              $countAvatars = $Files->countavailable('img/avatars/'.$userInfos['id']);
              //just for now as avatars do not have a table
            ?>
            <div class="card-body card-user-body card-custom-body" style="background-image: url('/img/avatars/<?= $userInfos['id'].'/'.$user_avatars?>')"> 
              <div class="gallery-name text-center">
                Avatars
              </div>
              <div class="galery-contains">
                <?= $countAvatars ?> pictures 
              </div>
            </div>
            <div class="card-footer card-custom-footer">
              <div class="right badge badge-success img-explorer">
                  <i class="fa fa-envelope-open-o fa-lg"></i> Explore
              </div>
            </div>
          </div>
        </div>
         <?php $communityImg = $Files->getCommunityImages($userInfos['id']);?>
        <div class="col-md-4">
          <div class="card mb-4 box-shadow">

            <div class="card-body card-user2-body card-custom-body" style="background-image: url('/img/<?= $communityImg ?>')">
              <div class="gallery-name text-center">
                Communities

              </div>
              <div class="galery-contains">
                <?= $Files->countCommunityImgages($userInfos['id'])?>
                 pictures 
              </div>
            </div>
            <div class="card-footer card-custom-footer">
              <div class="right badge badge-success img-explorer">
                  <i class="fa fa-envelope-open-o fa-lg"></i> Explore
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <?php $lastTmln = $Files->getlastTimelineImg($userInfos['id']);?>
            <div class="card-body card-user-body card-custom-body" style="background-image: url('/img/<?= $lastTmln ?>');">
              <div class="gallery-name text-center">
                Timelines
              </div>
              <div class="galery-contains">
                <?= $Files->countTimelineImgs($userInfos['id'])?> pictures
              </div>
            </div>
            <div class="card-footer card-custom-footer">
              <div class="right badge badge-success img-explorer">
                  <i class="fa fa-male"></i> Explore
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 box-shadow">
            <?php $lastPost = $Files->getlastPostImg($userInfos['id']);?>
            <div class="card-body card-user2-body card-custom-body" style="background-image: url('/img/<?= $lastPost ?>');">
              <div class="gallery-name text-center">
                Posts
              </div>
              <div class="galery-contains">
                <?= $Files->countUserPosts($userInfos['id'])?> pictures
              </div>
            </div>
            <div class="card-footer card-custom-footer">
              <div class="right badge badge-success img-explorer">
                  <i class="fa fa-male"></i> Explore
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end case albums -->