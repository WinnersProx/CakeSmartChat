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
    $this->assign('title', 'Create A Community');
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
        <span class="community-title"> 
          New Community from <?= $LoggedUser['User']['name']?> 
          <?= $this->Flash->render() ?>
        </span>
        <div id="communities-creation">
              <div>
                  Communitie Infos
              </div>
              
                <div class="col-md-12">
                  <form action="/communities/newCommunity" method="post">
                  <input type="hidden" name="creater_id" value="<?= $LoggedUser['User']['id']?>">
                  
                    <div class="form-group">
                      <label for="community_name">Community Name</label>
                      <input type="text" name="community_name" class="form-control" id="community_name" placeholder="The name of your community" required="required">
                    </div>
                    
                      <span class="community-title">Add Members</span>
                      <div class="community-details">
                        Don't worry you can add members now or later but it's better to add them right now!!!
                      </div>
                      
                      <div class="members">
                          <?php
                            $allUsers = $this->cell('UsersInfo')->listRegisteredCakeUsers();
                          ?>
                          <?php foreach ($allUsers as $aUser):?>
                            <div class="community-members">
                              <input type="checkbox" name="addMember[]" class="check-user" value="<?= $aUser['id']?>"><i class="fa fa-user"></i> <?= $aUser['name']?>
                            </div>
                            
                          <?php endforeach;?>
                      </div>
                    
                      <div class="form-group">
                        <label for="description">Description</label>
                         <input type="text" name="description" class="form-control" id="description" placeholder="What's your community target" required="required">
                      </div>
                      <input type="submit" name="new" class="btn btn-success" value="Create Now" id="submit-community" />
                </form>
              </div>
                
                
              
        </div>
    </div>
    
  </div>
  <div class="col-md-2">
      <div id="side-p" class="side-one">
         <?= $this->element('Inc/side_menu');?>
      </div>
  </div>
    
</div>

