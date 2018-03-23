<?php
	namespace App\View\Cell;
	use Cake\View\Cell;
	use Cake\Chronos\Chronos;
	class LiveUsersCell extends Cell{
		public function connected(){
			$connected = $this->request->session()
						 ->read('Auth')['User']['id'];
			return $connected;
		}
		public function getUserInfo($userId){
			$this->loadModel('Users');
			$user = $this->Users->findById($userId)->first();
			return $user;
		}
		public function checkRelation($idUser){
			$this->loadModel('Users');
			$connected = $this->connected();
			$dB = $this->Users->connectTocake();
			$check = $dB->newQuery()
			->select('*')
			->from('relations')
			->where(['sender_id' => $connected, 'receiver_id' => $idUser])
			->orwhere(['sender_id' => $idUser, 'receiver_id' => $connected])
			->andwhere(['status' => 1])
			->execute();
			$result = $check->rowCount();

			return boolval($result);
		}

		public function wasConnectedInLast($connectedTime){
			$currentTime = Chronos::parse('- 7 hours');
			$pastTime =  Chronos::parse($connectedTime,'- 7 hours');
			
			$currentMinutes = $currentTime->minute;
			$pastMinutes = $pastTime->minute;
			$checkMinutes = $currentMinutes - $pastMinutes;
			// if a day has just passed we will know it by testing if given minutes as connected time are greater than current minutes and surely the date;
			//
			if($currentTime->day == $pastTime->day && $currentTime->hour == $pastTime->hour){
				//debug('Past: '.$pastMinutes. ', Now: '.$currentMinutes. '='. $checkMinutes);
				if($checkMinutes <= 10){

					return true;
				}
				else{
					return false;

				}



			}
			else{
				return false;
			}


		}
		public function showOnlineUsers(){



			$this->loadModel('Users');
			$connected = $this->connected();
			$dB = $this->Users->connectTocake();

			$liveUsers = $dB->newQuery()
			->select('*')
			->from('live_users')
			->where(['live_status' => 1])
			->execute()
			->fetchAll('obj');

			foreach ($liveUsers as $live) {
				if($this->checkRelation($live->user_id)){

					$liveInfo = $this->getUserInfo($live->user_id);
					$created = $live->created_at;
					if($this->wasConnectedInLast($created)){	
						echo '<span class="user-online" data-liveuid="'.$live->user_id.'"><img class="user-avatar-xs" src="/img/'.$liveInfo['avatar'].'"/>'. ' '.$liveInfo['name']. ' <i class="fa fa-dot-circle-o status"></i></span><br>';		 

					}
					else{
						echo '<span class="user-online" data-liveuid="'.$live->user_id.'"><img class="user-avatar-xs" src="/img/'.$liveInfo['avatar'].'"/>'. ' '.$liveInfo['name']. ' <i class="fa fa-dot-circle-o status"> Busy</i></span><br>';
					}
					
				}
			}

		}
		


}