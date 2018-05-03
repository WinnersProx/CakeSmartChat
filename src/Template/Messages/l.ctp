<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title : ', 'SmartChat Instant Messaging(SMI)');
?>




    <!--<div class="col-md-3">
        <!<div id="left-p">
            $this->element('Inc/left_m_menu').
        </div>
    </div>
    <div class="col-md-6">
        <div  id="main-p">
             About messages-->
            
                    <!--<div id="tgglclass">
                        <span>Friendship!</span><br>
                        <span>Followship</span><br>
                        <span>Acquaintances</span><br>
                        <span>Knowledge</span>
                        <span>Instant Messaging!</span>
                    </div>-->
           <!-- #//$this->element('Inc/msg_menus');-->
        <div class="container main-section">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-5 left-sidebar">
                    
                    <div class="left-chat">
                         <div class="list-user-friends">
                            <?php
                                $uFriendsCell = $this->cell('UsersInfo');
                                $showuserFriends = $uFriendsCell->friendsLists($LoggedUser['User']['id']);
                                $messagesCell = $this->cell('Messages');
                            ?>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-7 col-sm-6 col-xs-5 right-sidebar">
                    
                    <div class="row">
                       <div class="right-header">
                            <div class="right-header-img">
                                <img src="/img/<?= $uFriendsCell->getUserInfo($receiverId)['avatar']?>">
                            </div>
                            <div class="right-header-detail">

                                <p><?= $uFriendsCell->getUserInfo($receiverId)['name']?></p>
                                <span>already <?= $messagesCell->countUserMessages($receiverId)?> messages </span>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-9 col-xs-12 right-header-contentChat msgs-lists">
                            
                            <span class="target-user" data-user-target="<?= $receiverId?>"></span>
                            <div class="inst-conversations" data-user-m="<?= $LoggedUser['User']['id']?>">
                                <?php
                                  isset($this->request->pass[0]) ? $user = $this->request->pass[0] : $user =  $receiverId;
                                $messages = $this->cell('Messages')->listMessages($user);
                                ?>
                            </div>
                            <div class="slidingMessages">
                                <span class="msg-box-error"></span>
                            </div>
                            <div id="endMsg">
                            </div>
                            
                        </div>
                        <form action="/messages/sendMessage/<?= isset($user) ? $user : ""?>" method="post" id="MsgBoxSender">
                            <div class="MsgInputBox right-chat-textbox">
                                <input type="text" name="msgSender" class="msgSender" placeholder="Type your message here!! Click enter to send" autocomplete="off" />
                                
                                <span class="msg-submit">
                                    <a href="#"><i class="fa fa-send" aria-hidden="true"></i></a>
                                </span>
                                

                            </div>
                                
                        </form>
                    </div>
                    
                </div>
                
            </div>
            <div class="visible-md" id="mOptions">
                This is new 
            </div>
        </div>
    
        <!--</div>
    </div>
    <div class="col-md-2  right-menu">
        <div id="side-p">
            //$this->element('Inc/side_menu');
        </div>
    </div>
</div>-->