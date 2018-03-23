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
                <ul class="side-nav">
                    <li class="heading"><?= __('Logged On') ?></li>
                    <li><i class="fa fa-user"></i> <?= $connected['name']?></li>
                     <li><i class="fa fa-google-plus"></i> <?= $connected['email']?></li>
                     <li><i class="fa fa-phone"></i> <?= $connected['phone']?></li>
                     <span class="badge row">
                        <li><i class="fa fa-book"></i> <?= $connected['about']?></li>
                     </span>    
                </ul>   
            <?php endif;?>  
            
        </div>
    </div> 

</nav>