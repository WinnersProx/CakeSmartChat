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
    $this->assign('title', 'Communities');
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
        <div  id="main-p">
        <span class="community-title"> 
          Hence you can find and create Smart Communities 
          <?= $this->Flash->render() ?>
        </span>
            <div id="communities">
                <div id="communities-lists">
                <?php $CommunityCell = $this->cell('Communities');?>
                
                <?php foreach ($communities as $community):?>
                  <?php
                    $countMembers = $CommunityCell->countMembers($community->id);
                  ?>
                    <div class="community-block">
                        <div class="community-description">
                          <div class="description-text">
                            <?= $community->com_description;?>
                          </div>
                          <span class="description-offset">
                          </span>
                           
                        </div>
                        <div class="community-contents">
                            <span class="comm-block-text">
                            <?= $CommunityCell->generateCommunityIcons($community->id)?>
                            </span>
                            <a href="/communities/view/<?= $community->community_name?>">
                            <?= $community->community_name;?>
                            <?php if():?>
                            <span class="count-members">(<?=  $CommunityCell->countMembers($community->id);?>)</span>
                            <?php endif;?>
                            </a>
                        </div>
                    </div>
                    
                <?php endforeach;?>
              </div>
              <div class="communities-options">
                <div class="communities-buttons">
                  <span class="btn-1">
                      <i class="fa fa-group fa-lg"></i><i class="fa fa-list-alt fa-custom"></i> Show All
                   </span>
                   <span class="btn-1">
                      <i class="fa fa-group fa-lg"></i><i class="fa fa-plus fa-custom"></i> <a href="/communities/create">Create New Community</a>
                   </span>
                </div>
                       
              </div>
            </div>
            <div class="communities-adds">
                <div class="community-title">
                  More On Communities
                </div>
                <div class="community-sub-infos">
                   A SmartChat community is a smart platform built by any smartchat registered user in order to get involved in other aspects of humans life concerning business, studies, sports and many more hence users are chiefs and can upload related posts depending on their wish as so to accomplish our task that is to make sure that people are linked all over the world and make it a smallest village!!!
                </div>
            </div> 
        </div>
    </div>
    <div class="col-md-2" id="community-side-m">
        <div id="side-p" class="side-one">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
    
</div>

