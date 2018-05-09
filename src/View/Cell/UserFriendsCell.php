<?php

namespace App\View\Cell;
use Cake\View\Cell;

class UserFriendsCell extends Cell{
	
	public function getUserInfos($userId){
		$this->loadModel('Users');
		$user = $this->Users->find()->where(['id' => $userId])->first();
		return $user;
	}

	public function getUserFriends($user_id, $getIndex = null){
		$getIndex = intval($getIndex); $getIndex == 0 ? $getIndex = 1 : $getIndex;
		
		$this->loadModel('Users');
		$sessionId = $this->request->session()->read('Auth')['User']['id'];
		$connect = $this->Users->connectTocake();
		

		$userFriends = $connect->newQuery()
		->select('*')
		->from('relations')
		->where(['sender_id' => $user_id, 'status' => 1])
		->orwhere(['receiver_id' => $user_id, 'status' => 1])
		->limit(3)
		->page($getIndex)
		->execute();

		$nbrFriends = $userFriends->rowCount();

		if($nbrFriends >=1){
			$friends = $userFriends->fetchAll('obj');
			foreach ($friends as $friend){
				$friend->receiver_id == $sessionId ? $targetFriend = $friend->sender_id : $targetFriend = $friend->receiver_id;

					$frName = $this->getUserInfos($targetFriend)['name'];
					echo '<input type="checkbox" name="tagFriend[]" value="'.$targetFriend.'" 
					/>'.$frName. ' ';
			}
		}
		else{
			echo 'You have actually no friends! ';
		}
		



	}
}