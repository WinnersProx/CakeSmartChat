<?php
namespace App\View\Cell;
use Cake\View\Cell;
use Cake\Utility\Inflector;
class UserAcquaintancesCell extends Cell{
	public function authUser(){
		return $this->request->session()->read('Auth')['User']['id'];
	}
	public function listFriendRequests(){
		//To get number of invitations
		$this->loadModel('Users');
		$sessionUser = $this->authUser();
		$dbb = $this->Users->connectTocake();
        $users = $dbb->newQuery()
        ->select('u.id,u.name,u.email,u.avatar')
        ->from('relations')
        ->join([
            'table' => 'users',
            'alias' => 'u',
            'type' =>  'LEFT',
            'conditions' => 'u.id = relations.sender_id'

        ])
        ->where(['relations.receiver_id' => $sessionUser,'relations.status !=' => 1])
        ->execute()
        ->fetchAll('assoc');
        return $users;
	}
	public function listAcquaintances(){
		$this->loadModel('Users');
		$sessionUser = $this->authUser();
		$dbb = $this->Users->connectTocake();

		$acquaintances = $dbb->newQuery()
            ->select(['id,name,avatar'])
            ->from('users')
            ->where(['id <>' => $sessionUser])
            ->execute()
            ->fetchAll('assoc');
        return $acquaintances;
	}
	public function checkRelation($targetUser){
		$this->loadModel('Users');
		$sessionUser = $this->authUser();
		$dbb = $this->Users->connectTocake();

		$check = $dbb->newQuery()
		->select('*')
		->from('relations')
		->where(['sender_id' => $sessionUser, 'receiver_id' => $targetUser])
		->orwhere(['sender_id' => $targetUser, 'receiver_id' => $sessionUser])
		->execute()
		->rowCount();
		
		return boolval($check);
	}

}