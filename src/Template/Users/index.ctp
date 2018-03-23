<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Index-Users :Welcome you will never be disappointed!');
?>
<div class="container">
    <div class="row" id="main-block">
        <div class="col-md-3" id="left-p">
            <nav id="actions-sidebar">
                <ul class="side-nav">
                    <li class="heading"><?= __('Menus') ?></li>
                    <li><?= $this->Html->link(__('Signup'), ['action' => 'signup']) ?></li>
                    <li><?= $this->Html->link(__('Log out'), ['action' => 'login']) ?></li>
                    <li class="heading"><?= __('Logged On') ?></li>
                    <li> he'smail@gmail.com</li>
                </ul>
            </nav>
        </div>
        <div class="col-md-5" id="main-p">
                    <span class="announce">Welcome Here is a friendship app maker try to create an account you will see how good and easy it's!</span>
                    <br>
                    <div id="tgglclass">
                        <span>Friendship!</span><br>
                        <span>Followship</span><br>
                        <span>Acquaintances</span><br>
                        <span>Knowledge</span><br>
                        <span>Instant Messaging!</span>
                    </div>
        </div>
        <div class="col-md-2 pull-right" id="side-p">
            <div>
                 <h6 class="b">These are People you may know!</h6>
                        <div class="row" >
                            <div class="col-md-7 ">
                                <div class="col-md-10">
                                <div id="myCarousel" class="carousel slide fix"> <!-- Carousel indicators --> 
                                    <ol class="carousel-indicators"> 
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"> </li>
                                        <li data-target="#myCarousel" data-slide-to="1"></li> 
                                        <li data-target="#myCarousel" data-slide-to="2"></li> 
                                    </ol> <!-- Carousel items --> 
                                    <div class="carousel-inner"> 
                                        <div class="item active"> 
                                            <img src="/img/1.png" alt="First slide" class="user-avatar-md"> 
                                        </div> 
                                        <div class="item"> <img src="/img/2.png" alt="Second slide" class="user-avatar-md"> </div> 
                                        <div class="item"> <img src="/img/3.png" alt="Third slide" class="user-avatar-md"> </div> 
                                        </div> <!-- Carousel nav --> 
                                        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a> </div>
                                 </div>
            
                        
                            </div>
                    
                        </div>
                  
                    </div>
        </div>
        
    </div>
</div>
<div class="chat-box">
    <div class="chat-box-header">
        Chat avec WinnersProx<span class="chat-box-alert"></span>
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


