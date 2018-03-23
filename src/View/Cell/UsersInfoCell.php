<?php
namespace App\View\Cell;
use Cake\View\Cell;
use Cake\Chronos\Chronos;

class UsersInfoCell extends Cell{

	public function getCurrentUser(){
		$sessionId = $this->request->session()->read('Auth')['User']['id'];
		return $sessionId;
	}

	public function getUserInfo($userId){
		$this->loadModel('Users');
		$userInfos = $this->Users->findById($userId)->first();
		return $userInfos;
	}
	public function checksConnection($userId){
		$dB = $this->Users->connectTocake();
		$userConnection = $dB->newQuery()
		->select('*')
		->from('live_users')
		->where(['user_id' => $userId, 'live_status' => 1])
		->execute();
		$result = $userConnection->rowCount();
		$result = boolval($result);
		if($result){
			$found = $userConnection->fetch('obj');
			$tdayTime = Chronos::parse('- 7 hours');
			$dated = Chronos::parse($found->created_at, '- 7 hours');
			if($dated->day == $tdayTime->day)
			{
				$result = true;
			}
			else
			{
				$result = false;
			}
		}
		
		return $result;

	}

	public function friendsLists($user){
		$this->loadModel('Users');
		$dBC = $this->Users->connectTocake();
		$frLists = $dBC->newQuery()
		->select('*')
		->from('relations')
		->join([
			'alias' => 'u',
			'table' => 'users',
			'type' => 'RIGHT',
			'conditions' => 'u.id = sender_id OR receiver_id = u.id'
		])
		->where(['sender_id' => $user, 'status' => 1])
		->orwhere(['receiver_id' => $user, 'status' => 1])
		->execute();
		$count = $frLists->rowCount();
		$fetChFriends = $frLists->fetchAll('obj');
		if($count > 0){
			foreach ($fetChFriends as $sFriend) {
				
				if($sFriend->id != $this->getCurrentUser()){
					if($this->checksConnection($sFriend->id)){
						$flag = '<span class="connect-status"></span>';
					}
					else{
						$flag = '';
					}

					echo 
						'<a href="/messages/l/'.$sFriend->id.'">
							<div class="userFriend">
							
							<img src="/img/'.$sFriend->avatar.'" class="user-avatar-xs"/>'.$flag. ' ' .$sFriend->name.
							'</div>
						</a>';
				}
				
			}

		}
		else{
			echo "you do not have friends";
		}


	}
}