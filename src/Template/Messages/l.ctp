<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title : ', 'SmartChat Instant Messaging(SMI)');
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p">
            <?= $this->element('Inc/left_m_menu');?>
        </div>
    </div>
    <div class="col-md-6">
        <div  id="main-p">
            <!-- About messages-->
            
                    <!--<div id="tgglclass">
                        <span>Friendship!</span><br>
                        <span>Followship</span><br>
                        <span>Acquaintances</span><br>
                        <span>Knowledge</span>
                        <span>Instant Messaging!</span>
                    </div>-->
           <?= $this->element('Inc/msg_menus');?> 
        </div>
    </div>
    <div class="col-md-2  right-menu">
        <div id="side-p">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
</div>