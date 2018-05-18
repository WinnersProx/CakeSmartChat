<nav id="actions-sidebar">
    <div id="profile-box">
        <?php if($this->name == 'Users' || $this->name == 'Communities'):?>
        <div id="back">
            <div class="back">   
            </div>
            
            <div class="img">
                <?= $this->Html->Image($LoggedUser['User']['avatar'],['class' => 'user-avatar-md img-user'])?>
            </div>
            <ul class="side-nav users-side-nav">
                <li class="heading"><?= __('More') ?></li>
                     <li><a href="/communities"><i class="fa fa-group"></i> COMMUNITIES</a></li>
                     <li><a href=""><i class="fa fa-comments-o"></i> SIM</a></li>
                     <li><a href=""><i class="fa fa-picture-o"></i> ALBUMS</a></li>
                     <li><a href=""><i class="fa fa-info-circle"></i> EVENTS</a></li>
                     <li class="last">
                        <a href=""><i class="fa fa-user-plus"></i> FIND FRIENDS</a>
                    </li>
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
                <div class="user-menus">
                    <li><a href="/communities"><i class="fa fa-group"></i> COMMUNITIES</a></li>
                     <li><a href=""><i class="fa fa-comments-o fa-lg"></i> SIM</a></li>
                     <li><a href=""><i class="fa fa-picture-o"></i> ALBUMS</a></li>
                </div>
                <div class="contacts">
                    <li class="heading"><?= __('Contacts') ?></li>
                     <div class="user-contacts">
                        <li><i class="fa fa-user"></i> <?= $userInfos['name']?></li>
                        <li><i class="fa fa-google-plus"></i> <?= $userInfos['email']?></li>
                        <li><i class="fa fa-phone"></i> <?= $userInfos['phone']?></li> 
                     </div>
                </div>

                <div class="about-me">
                   <li class="heading"><?= __('About '. $userInfos['name']) ?></li>
                    <div class="c-badge-r">
                        <i class="fa fa-book fa-lg"></i><?= $userInfos['about']?>
                    </div> 
                </div>
                 
                
            </ul>
        <?php endif;?>
    </div> 

</nav>