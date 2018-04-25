<?php
namespace App\View\Cell;
use Cake\View\Cell;
Use Cake\Chronos\Date;
class UsersEventsCell extends Cell{
	public function checkUserBirthDay($userId = null){
		$userId = intval($userId);
		$this->loadModel('Users');
		$checkUser = $this->Users->find()->select('user_dob')->where(['id' => $userId])->first();

		if($checkUser){
			$toDay = new Date();
			$userDob = new Date($checkUser['user_dob']);
			
			if($userDob->day == $toDay->day && $userDob->month == $toDay->month){
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

}