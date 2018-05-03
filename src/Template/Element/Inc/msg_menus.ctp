<div class="Messages-opts">
	<div class="msg-header">
		Welcome to SMI(SmartChat Instant Messaging) <i class="fa fa-spin"></i>
		<span class="flash"><?= $this->Flash->render()?></span>
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