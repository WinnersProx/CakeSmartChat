<nav id="actions-sidebar">
    <div class="row" id="profile-box">
        <div class="col-md-3 col-sm-3 col-xs-5" id="back">
            <?php if($this->name == 'Users'):?>
            <div class="back">   
            </div>
            
            <div class="img">
                <?php if($connected['avatar']):?>
                    <?= $this->Html->Image($connected['avatar'],['class' => 'user-avatar-md img-user'])?>
                <?php else:?>
                     <?= $this->Html->Image('user.png',['class' => 'user-avatar-md img-user'])?>
                <?php endif;?>
            </div>
                <ul class="side-nav users-side-nav">
                    <li class="heading"><?= __('More') ?></li>
                     <?php if($this->view == 'timeline'):?>
                         <li><a href=""><i class="fa fa-group"></i> COMMUNITIES</a></li>
                         <li><a href=""><i class="fa fa-comments-o fa-lg"></i> SIM</a></li>
                         <li><a href=""><i class="fa fa-picture-o"></i> ALBUMS</a></li>
                         <li><a href=""><i class="fa fa-info-circle fa-lg"></i> FRIENDS EVENTS</a></li>
                     <?php endif;?>
                     <?php if($this->view == 'profile'):?>
                         <li><i class="fa fa-user"></i> <?= $connected['name']?></li>
                         <li><i class="fa fa-google-plus"></i> <?= $connected['email']?></li>
                         <li><i class="fa fa-phone"></i> <?= $connected['phone']?></li>
                         <span class="badge-custom c-badge-r">
                            <span><i class="fa fa-book fa-lg"></i> <?= $connected['about']?></span></li>
                         </span>
                     <?php endif;?>   
                </ul>   
            <?php endif;?>  
            
        </div>
    </div> 

</nav>