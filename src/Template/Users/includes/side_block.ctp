<div class="row" id="invite">
    <div class="col-md-11" id="invitations">
        <h6 class="b">Invitations</h6>
        <?php foreach($users as $user):?>
        <?php if($user['avatar']):?>
            <?= $this->Html->Image('../'.$user['avatar'],['class' => 'user-avatar-xs'])?> 
            <?php else:?>
                <?= $this->Html->Image('user.png',['class' => 'user-avatar-xs'])?>
            <?php endif;?>
            <span class="user-info"><?= h($user['name'])?></span>
                <?=$this->Html->link(__('Confirm'),['controller'
                => 'Users', 'action' => 'confirm',$user['id'],$connected['id']],['class' =>'fa fa-send ajaxConfirm'])
        ?><br/>
    <?php endforeach;?> 
    </div>
</div>
<div class="row">
    <div class="col-md-11" id="people">
    <h6 class="b">These are People you may know!</h6>
    <?php foreach($acquaintances as $people):?>
        <?php if($people['avatar']):?>
           <?= $this->Html->Image('../'.$people['avatar'],['class' => 'user-avatar-xs'])?> 
        <?php else:?>
            <?= $this->Html->Image('user.png',['class' => 'user-avatar-xs'])?>
        <?php endif;?>
        <?= h($people['name'])?>
            <?=$this->Html->link(__('Invite'),['controller'
            => 'Users', 'action' => 'testnavig',$people['id']],['class' =>'fa fa-send ajaxInvite'])
        ?><br/>
    <?php endforeach;?>
    <span class="comment">    
    </span>

    </div>
</div>