<div class="Messages-opts">
	<div class="msg-header">
		Welcome to SMI(SmartChat Instant Messaging)
		<span class="flash"><?= $this->Flash->render()?></span>
	</div>
	<div class="msgs-lists">
		<?php if($this->request->pass):?>
			<span class="target-user" data-user-target="<?= $receiverId?>"></span>
			<div class="inst-conversations" data-user-m="<?= $LoggedUser['User']['id']?>">
				<?php
				$user = $this->request->pass[0];
				$messages = $this->cell('Messages')->listMessages($user);
				?>
			</div>
		<?php endif;?>
		<div class="slidingMessages">
			<span class="msg-box-error"></span>
		</div>
		<div id="endMsg">
		</div>
	</div>
	<div class="MsgBoxS">
		<form action="/messages/sendMessage/<?= isset($user) ? $user : ""?>" method="post" id="MsgBoxSender">
			<div class="MsgInputBox">
				<input type="text" name="msgSender" class="msgSender" placeholder="Type your message here!! Click enter to send" autocomplete="off" />

			</div>
			<div class="custFsub">
				<i class="fa fa-send fa-lg fSender"></i>
			</div>
		</form>
		
	</div>
	
</div>