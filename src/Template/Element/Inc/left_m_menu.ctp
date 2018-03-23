<div id="messages">
    <div class="row" id="msg-left-block">
     	<?php if($this->name == 'Messages'):?>
        <div class="messages-header">
            <span class="heading"><?= __('SMI Chat') ?></span> 
        </div>
        <div class="list-user-friends">
        	<?php
        		$uFriendsCell = $this->cell('UsersInfo');
        		$showuserFriends = $uFriendsCell->friendsLists($LoggedUser['User']['id']);
        	?>
        </div>

		<?php endif;?>
    </div> 

</div>