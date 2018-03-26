<?php
namespace App\View\Cell;
use Cake\View\Cell;
//use Cake\Datatsource\Paginator;
class MessagesCell extends Cell{
	
	public function userInfos($idUser){
		$this->loadModel('Users');
		$user = $this->Users->findById($idUser)->first();
		return $user;
	}
	public function listMessages($tFriend){
		$this->loadModel('Messages');
		$tFriend = intval($tFriend);
		$connectedId = $this->request->session()->read('Auth')['User']['id'];
		$connect = $this->Messages->connectTocake();
		// $messages = $this->Messages->find()
		// ->where(['Messages.m_sender' => $connectedId,'Messages.m_receiver' => $tFriend])
		// ->orwhere(['Messages.m_receiver' => $connectedId, 'Messages.m_sender' => $tFriend]);
		 $messages = $connect->newQuery()
		 ->select('*')
		 ->from('messages')
		 ->join([
		 	'table' => 'users',
		 	'alias' => 'u',
		 	'type'  => 'LEFT',
		 	'conditions' => 'u.id = m_sender'
		 ])
		 ->where(['m_sender' => $connectedId,'m_receiver' => $tFriend])
		 ->orwhere(['m_receiver' => $connectedId,'m_sender' => $tFriend])
		 ->execute()
		 ->fetchAll('assoc');
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
		
	}
	public function countNewMessages(){
		$this->loadModel('Messages');
		$connect = $this->Messages->connectTocake();
		$connectedId = $this->request->session()->read('Auth')['User']['id'];
		$newMessages = $connect->newQuery()
		->select('*')
		->from('messages')
		->where(['m_receiver' => $connectedId, 'm_status' => 0])
		->execute()
		->rowCount();
		return $newMessages;
	}
}
?>
