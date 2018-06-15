<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title : ', 'SmartChat Instant Messaging(SMI)');
?>

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
                        <div class="msg-box-error"> 
                        </div>
                    </div>
                    <div id="endMsg">
                    </div>
                    
                </div>
                <form action="/messages/sendMessage/<?= isset($user) ? $user : ""?>" method="post" id="MsgBoxSender">
                    <div class="MsgInputBox right-chat-textbox">
                        <input type="text" name="msgSender" class="msgSender" placeholder="Type your message here!! Click enter to send" autocomplete="off" />
                        
                        <span class="msg-submit">
                            <a><i class="fa fa-send"></i></a>
                        </span>
                        

                    </div>
                    <audio  id="msgSent">
                        <source src="/streams/msg_sent.ogg" type="audio/ogg" />
                        <source src="/streams/msg_sent.mp3" type="audio/mp3" />
                    </audio>    
                </form>
            </div>
            
        </div>
        
    </div>
    <div class="visible-md" id="mOptions">
        This is new 
    </div>
</div>
