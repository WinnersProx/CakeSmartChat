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
    <div class="row">
      <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
      <div  id="main-p">
        <div class="community-banner">
          <div class="top-community-description">
            <i class="fa fa-cog"></i>
          </div>

          <div class="main-community-description">
            <span class="btn btn-community btn-outline-primary">
              <i class="fa fa-level-up"></i> Rate
            </span>
            <span id="community-image">
              <?= $CommunityCell->generateCommunityIcons($targetCommunity->id)?>
            </span>
            <span class="btn btn-community btn-outline-primary">
              <?php if(!$CommunityCell->checkCommunityMembership($targetCommunity->id)):?>
                  <a href="/communities/joinCommunity/<?= $targetCommunity->id ?>"><i class="fa fa-link"></i> Join</a>
              <?php else :?>
                  <a href="/communities/joinCommunity/<?= $targetCommunity->id ?>"><i class="fa fa-unlink"></i> Leave</a>
              <?php endif;?>
              
            </span>
          </div>  
        </div>
        <!--end of banner now menus -->
        <div class="community-menus">
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
        <div class="community-posts" id="post-baker">
          <form action="/communities/newPost/<?=$targetCommunity->community_name?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <textarea class="form-control custom-text-field" name="community-post-content" placeholder="New Post in <?= $targetCommunity->community_name ?> community " required></textarea>
              <div class="bottom-menu">
              <!--to append the modal -->
              <div class="post-validator" data-toggle="modal" data-target="#CommunityPostOpts">
                <i class="fa fa-check-circle fa-lg"></i>
              </div>
              <!--End to appending the modal-->

              <!--to upload a picture -->
              <div id="liveImageUpload" data-toggle="modal" data-target="#liveImg"><i class="fa fa-camera fa-lg"></i></div>
            </div>
            </div>
            <!--the modal now concerning the new post in this community-->
            <div class="modal fade" tabindex="-1"  id="CommunityPostOpts">
        <div class="modal-dialog" id="postModal">
          <div class="modal-content">
            <div class="modal-header postModalHeader">
              <span class="modal-title">
                <i class="fa fa-check"></i> Validate your new post in <?= $targetCommunity->community_name?> community</span>
              <span class="close" data-dismiss="modal" aria-hidden="true"> &times; </span>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-7">
                  <span class="badge post-opts"><i class="fa fa-font"></i> Post Content </span>
                  <div class="post-text">
                  </div>
                  <br/>
                  <div class="post-images">

                    <span class="badge post-opts"><i class="fa fa-picture-o"></i> Post Images</span> 
                    <div class="img-transfer">
                      <input type="file" name="post-pictures[]" class="img-upload" multiple="multiple">
                      <span >
                                  <span class="post-img-baker custom-baker">
                                  <i class="fa fa-upload"></i> Pictures
                                  </span>
                                </span>
                    </div>
                    <div class="img-preview uploader-text">
                      <i>None selected!</i>
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-5">
                  <span class="badge post-opts"> <i class="fa fa-certificate"></i>Post Options</span><br/>
                  <div id="post-options">
                    <span class="badge post-opts-bdg tag">Tag with</span><span class="badge post-opts-bdg privacy">Post privacy</span><br>
                    <!-- for my tags-->
                    <div class="tag-infos">
                      <?php
                        $this->cell('UserFriends')->getUserFriends($LoggedUser['User']['id']);
                      ?>
                    </div>
                    
                    <!--for my tags-->
                    
                    <!--for my privacy infos-->
                    
                      <span class="privacy-setter">Privacy</span>
                      <select name="post-privacy" class="community-post-privacy">
                        <option value="0">Public</option>
                        <option value="1">Members</option>
                        <option value="2">Private</option> 
                      </select>
                    
                    <!--for my privacy infos-->
                  </div>  
                </div>
                
              </div>
              
              <div class="poster">

              </div>  
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success submit-b" name="community-post-submit"><i class="fa fa-edit fa-lg"></i> New Post</button>
            </div>
          </div>
        </div>
      </div>
            <!--To put in the modal
            <div class="row">
              <div class="col-md-8 col-xs-7">
                <div class="post-pictures">
                  <input type="file" name="post-pictures[]" class="picture-baker" value="Add Pictures" multiple="multiple">
                  <span>
                    <span class="post-img-baker customized-uploader">
                    <i class="fa fa-upload"></i> Image
                    </span>
                  </span>
                  <span class="privacy-setter">Privacy</span>
                    <select name="post-privacy" class="community-post-privacy">
                      <option value="0">Public</option>
                      <option value="1">Members</option>
                      <option value="2">Private</option> 
                  </select>
                  
                </div>
              </div>
              <div class="col-md-4 col-xs-3">
                <div class="bottom-button right">
                  <button type="submit" name="community-post-submit" class="btn btn-secondary community-post-submit">
                    <i class="fa fa-edit"></i> New Post
                  </button>
                </div>
                
              </div>  
            </div>-->
          </form>
        </div>
        <div class="render">
          <?= $this->Flash->render()?>
        </div>
        <div class="post-lists">
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
    
</div>

