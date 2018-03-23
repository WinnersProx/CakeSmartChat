<?php

namespace App\View\Cell;
use Cake\View\Cell;

class UserFriendsCell extends Cell{
	
	public function getUserFriends($user_id){
		$this->loadModel('Users');
		$sessionId = $this->request->session()->read('Auth')['User']['id'];
		$connect = $this->Users->connectTocake();
		$userFriends = $connect->newQuery()
		->select('*')
		->from('relations')
		->join([
			'table' => 'users',
			'type'  => 'RIGHT',
			'alias' => 'u',
			'conditions' => 'u.id = sender_id OR u.id = receiver_id'
		])
		->where(['sender_id' => $user_id, 'status' => 1])
		->orwhere(['receiver_id' => $user_id, 'status' => 1])
		->execute();
		$nbrFriends = $userFriends->rowCount();
		if($nbrFriends >=1){
			$friends = $userFriends->fetchAll('obj');
			foreach ($friends as $friend){
				if($friend->id != $sessionId){
					echo '<input type="checkbox" name="tagFriend[]" value="'.$friend->id.'" 
					/>'.$friend->name. '<br/>';
				}
				
				
			}
		}
		else{
			echo 'You have actually no friends! ';
		}
		



	}
}