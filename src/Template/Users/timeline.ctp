<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Timeline : Welcome '.$connected['name']);
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
        <div  id="main-p">
            <?= $this->element('Inc/main_menu');?>
            
                    <!--<div id="tgglclass">
                        <span>Friendship!</span><br>
                        <span>Followship</span><br>
                        <span>Acquaintances</span><br>
                        <span>Knowledge</span>
                        <span>Instant Messaging!</span>
                    </div>-->
        </div>
    </div>
    <div class="col-md-2  right-menu">
        <div id="side-p">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>



<!--For the chat box once visible-->
<div class="chat-box row">
    <div class="chat-box-header">
        Chat with WinnersProx<span class="chat-box-alert"></span>
    </div>
    <div class="chat-contents">
        <div class="chat-contents-msgs">
            Vainqueur : salut monsieur sg
            shg : wow hereux de revoir maitre
        </div>
        <div class="chat-contents-input">
            <form method="post">
                <div class="form-group">
                    <textarea name="new-chat" class="form-control msgBox" placeholder="votre message ici" rows="1"></textarea> 
                </div>
                <input type="submit" name="sendmsg" class="btn btn-xs btn-primary" value="send">
            </form>
            <br>
            
        </div>
    </div>

</div>