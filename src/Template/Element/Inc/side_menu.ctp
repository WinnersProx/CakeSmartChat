<?php if($this->name == 'Users'):?>
<div class="row" id="side-menu">
    <span class="side-title">Invitations</span>
    <div class="col-md-12" id="people">
        <?php 
            $users = $this->cell('UserAcquaintances')->listFriendRequests();
            $acquaintances = $this->cell('UserAcquaintances')->listAcquaintances();
            $userAcquaint = $this->cell('UserAcquaintances');
        ?>
        <?php foreach($users as $user):?>
            <img src="/img/<?= $user['avatar'] ?>" class="user-avatar-xs">
            <span class="user-info"><?= h($user['name'])?></span>
                <?=$this->Html->link(__('Confirm'),['controller'
                => 'Users', 'action' => 'confirm',$user['id'],$connected['id']],['class' =>'fa fa-send ajaxConfirm'])
        ?><span class="status"></span><br/>
    <?php endforeach;?> 
    </div>
</div>
<div class="row" id="side-menu">
    <span class="side-title">People you may know!</span>
    <div class="col-md-12" id="people">
    <?php foreach($acquaintances as $people):?>
        <?php if(!$userAcquaint->checkRelation($people['id'])):?>

            <img src="/img/<?= $people['avatar'] ?>" class="user-avatar-xs"/> 
            <?= h($people['name'])?>
                <?= $this->Html->link(__('Invite '),['controller'
                => 'Users', 'action' => 'sendRequest',$people['id']],['class' =>'fa fa-user-plus ajaxInvite'])
            ?><span class="status"></span><br/>
        <?php endif;?>
    <?php endforeach;?>
    <span class="comment">    
    </span>

    </div>
</div>
<?php endif;?>
<div class="row" id="side-menu">
    <span class="side-title">Online Friends</span>
    <div class="col-md-12 users-online" id="people">
        <?= $this->cell('LiveUsers')->showOnlineUsers();?>
    </div>
    
</div>