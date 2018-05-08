<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" width="device-width" initial-scale="1.0" targetdensitydpi="
    device-dpi" user-scalable=no>
    <meta name="description" content="Articles">
    <meta name="author" content="WinnersProx">
   <!-- <link rel="shortcut icon" type="images/x-icon" href="/img/smartnet.png">-->
    <title>
     <?= $this->fetch('title');?>
    </title> 
    <?=$this->fetch('css');?>
    <?= $this->Html->css('bootstrap');?>
    <?= $this->Html->css('base');?>
    <?= $this->Html->css('main');?>
    <?= $this->Html->css('adapts');?>
    <?= $this->Html->css('font-awesome/css/font-awesome.min')?>
    <!-- $this->Html->script('/js/node_modules/socket.io-client/dist/socket.io')?>-->
</head>
 
 <body data-cont-name="<?= $this->name?>">
    
    <div class="container">
            
            <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
               
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarcollapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand s-name" href="/users/timeline">SmartChat</a> 
                </div>
                <div class="col-md-4" id="psearch">
                    <div class="form-group">
                        <input type="search" name="q" placeholder="Seeker" class="form-control" id="search" autocomplete="off" /><i class="fa fa-spinner fa-spin" style="display: none;" id="loader"></i>
                        <div id="show_results">
                            
                        </div>

                        <!--<input type="submit" name="seek" value="V" class="btn btn-search">-->
                    </div>
                    
                </div>
                <div class="collapse navbar-collapse" id="navbarcollapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if($LoggedUser):?>
                            <li><a href="/users/timeline"><strong><i class="fa fa-home fa-lg"></i> Home</strong></a></li>
                            <li>
                                <?php
                                    $news = $this->cell('Messages')->countNewMessages();
                                ?>
                                <a href="/messages">
                                    <strong><i class="fa fa-envelope fa-lg"></i> Messages</strong>
                                    <?php if($news>0):?>
                                        <span class="m-counts"><?= $news?></span>
                                    <?php endif;?>
                                </a>
                            </li>
                            <li>
                                <a href="/users/notificationsList" class="toggle-notifs">
                                    <strong><i class="fa fa-comment fa-lg"></i> Notifications</strong>
                                    <span class="notif"></span>
                                </a>
                            </li>

                        <li>
                            
                            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                                <?php if($LoggedUser['User']['avatar']):?>
                                    <?= $this->Html->Image($LoggedUser['User']['avatar'],['class' => 'user-avatar-lu'])?>
                                <?php else:?>
                                    <?= $this->Html->Image('user.png',['class' => 'user-avatar-lu'])?>
                                <?php endif;?>
                                <span class="fa fa-chevron-down"></span>
                                
                                <ul class="dropdown-menu menu-drop">
                                    <li><a href="/profiles/u/<?= $LoggedUser['User']['name']?>"><strong><i class="fa fa-user-md fa-lg"></i> Profile</strong></a></li>
                                    <li class="divider"></li>
                                    <li><a href="/users/logout"><strong><i class="fa fa-power-off fa-lg"></i> Logout</strong></a></li>
                                    
                                </ul>
                        </li>
                        
                        <?php else:?>
                            <li class="b"><a href="/users/login"><strong><i class="fa fa-toggle-on fa-lg"></i> Login</strong></a></li>
                            <li class="b"><a href="/users/signup"><strong><i class="fa fa-sign-in fa-lg"></i> Sign Up</strong></a></li>
                            <li class="b"><a href="/users/logout"><strong><i class="fa fa-key fa-lg"></i> Forgot Password</strong></a></li>
                        <?php endif;?>     
                    <div id="notif-view">
                                                    
                    </div>
                    
                    </ul>

                </div>
                <div class="mobx-nav-list">
                    <?php if($LoggedUser) : ?>
                        <span><i class="fa fa-envelope"> <a href="/messages/l">Message</a></i></span>
                        <span><i class="fa fa-bell"> <a href="/users/notificationsList">Notifications</a></i></span>
                        <span class="toggle-menus u-xs-options">
                            <i class="fa fa-arrow-circle-left t-uxs-menus"></i>
                        </span>
                    <?php else:?>
                        <span><i class="fa fa-toggle-on"></i> <a href="/users/login">Login</a></span>
                        <span><i class="fa fa-sign-in"></i> <a href="/users/signup">Sign Up</a></span>
                    <?php endif;?>
                </div>
            </div>
            
        </div>
        
    </div>
    <div class="container-fluid" id="main_wrapper">
        <?= $this->fetch('content');?>
        
<!--For the chat box once visible-->
        <div id="appendable-boxes">
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
                        <form action="/messages/sendMessage/" method="post" id="MsgBoxSender">
                            <div class="MsgInputBox">
                                <input type="text" name="msgSender" class="msgSender" placeholder="Type your message here!! Click enter to send" autocomplete="off" />

                            </div>
                            <div class="custFsub">
                                <i class="fa fa-send fa-lg fSender"></i>
                            </div>
                        </form>
                    </form>
                    <br>
                    
                </div>
            </div>

        </div> 
        </div>

        <!--Chat box end -->
        <!--menus for xs mb users -->
        <?php if($LoggedUser):?>
         <div id="UxsSideMenu">
              
              <div class="connected-auth-menus">
                <div>

                    <?= $this->Html->image('/img/'.$LoggedUser['User']['avatar'], ['class' => 'user-mobxs-avatar'])?>
                </div>
                 
              </div>
              <div class="u-xs-s-menus">
                <?= $this->element('uxs_side_menu')?>
                  
              </div>

         </div>
         <?php endif;?>
         <div id="scroller" title="click to go upper">
             <i class="fa fa-arrow-circle-up fa-lg"></i>
         </div>
        <!--menus for xs mob users -->
        
        <!--Scripts javascript-->

        <!--Local jquery for Js-->
        <?= $this->Html->script('jquery.min')?>
        <!-- Include all compiled plugins (below), or include individual files as needed-->
        <?= $this->Html->script('bootstrap')?>
        <!-- <script src="libraries/parsley/parsley.min.js"></script>
        <script src="libraries/i18n/fr.js"></script>-->
        <?= $this->Html->script('main')?>
        <?= $this->Html->script('navig')?>
        <?= $this->Html->script('custom')?>

        <?=$this->fetch('script');?>

</body>

       
    
        