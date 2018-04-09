<nav id="actions-sidebar">
    <div class="row" id="profile-box">
        <?php if($this->name == 'Users' || $this->name == 'Communities'):?>
        <div class="col-md-3 col-sm-3 col-xs-5" id="back">
            <div class="back">   
            </div>
            
            <div class="img">
                <?= $this->Html->Image($LoggedUser['User']['avatar'],['class' => 'user-avatar-md img-user'])?>
            </div>
                <ul class="side-nav users-side-nav">
                    <li class="heading"><?= __('More') ?></li>
                         <li><a href="/communities"><i class="fa fa-group"></i> COMMUNITIES</a></li>
                         <li><a href=""><i class="fa fa-comments-o fa-lg"></i> SIM</a></li>
                         <li><a href=""><i class="fa fa-picture-o"></i> ALBUMS</a></li>
                         <li><a href=""><i class="fa fa-info-circle fa-lg"></i> EVENTS</a></li>
                         <li><a href=""><i class="fa fa-user-plus fa-lg"></i> FIND FRIENDS</a></li>
                </ul>   
              
            
        </div>
        <?php endif;?>
        <?php if($this->name == 'Profiles'):?>
            <div class="users-details">
               <span>
                <?php $cUserName = 'My'; $userInfos['name'] == $LoggedUser['User']['name'] ? $cUserName : $cUserName = $userInfos['name']."'s"
                ?>
                <i class="fa fa-user c-on"></i> <?= $cUserName?> Profile
                </span> 
            </div>
            <ul class="side-nav users-side-nav">
                <li><a href="/communities"><i class="fa fa-group"></i> COMMUNITIES</a></li>
                 <li><a href=""><i class="fa fa-comments-o fa-lg"></i> SIM</a></li>
                 <li><a href=""><i class="fa fa-picture-o"></i> ALBUMS</a></li>
                 <li class="heading"><?= __('Contacts') ?></li>
                 <div class="user-contacts">
                    <li><i class="fa fa-user"></i> <?= $userInfos['name']?></li>
                    <li><i class="fa fa-google-plus"></i> <?= $userInfos['email']?></li>
                    <li><i class="fa fa-phone"></i> <?= $userInfos['phone']?></li> 
                 </div>
                <li class="heading"><?= __('About '. $userInfos['name']) ?></li>
                <div class="c-badge-r">
                    <i class="fa fa-book fa-lg"></i><?= $userInfos['about']?>
                </div>
            </ul>
        <?php endif;?>
    </div> 

</nav>