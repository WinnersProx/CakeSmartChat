<?php
foreach ($messages as $message) {
    if($message['id'] == $connectedId){
        echo 
        '<div class="me">
            <div class="user-message">
                <span class="message-text">
                    <span class="u-name"> '.$message['name'].'</span> '.h($message['m_content']).'</span>
                    </span>
            </div>
                        
        </div>';

    }
    else{
        echo 
        '<div class="users-messages myFriend">
            <div class="user-photo">
                <img src="/img/'.$message['avatar'].'" class="user-avatar-xs"/>
            </div>
            <div class="user-message">
                <span class="message-text">
                    <span class="u-name"> '.$message['name'].'</span> 
                    <span class="m-content">'.h($message['m_content']).'</span>
                </span>
            </div>
                        
        </div>';

    }
            
}
?>