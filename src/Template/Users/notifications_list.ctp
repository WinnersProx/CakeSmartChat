<?php if($nbrNotifs < 1):?>
<p><?= $empty ?></p>
<?php else:?>
<?php foreach($notifications as $notif):?>
	<span class="notif-lst"><?= 
	($notif->avatar) 
	? $this->Html->Image($notif->avatar,['class' => 'user-avatar-lu'])
	: $this->Html->Image('user.png',['class' => 'user-avatar-lu'])
	?> 
	<?= $notif->name?> <?= $notif->content ?>
	<?= ($notif->object == 'request' && $notif->status == 0)
	? $this->Html->link(' Confirm',['controller'=> 'Users', 'action' => 'confirm',$notif->user_id, $notif->target_user],['class' => 'fa fa-send ajaxConfirm']) 
	: 'You are now friends'
	?><span class="status"></span>
	
	</span>
	<span class="divide"></span>
<?php endforeach;?>
<?php endif;?>