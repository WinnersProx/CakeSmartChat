<?php
namespace App\View\Cell;
use Cake\View\Cell;
class CommunitiesCell extends Cell{

	public function getMemberInfos($memberId){
		$this->loadModel('Users');
		$user = $this->Users->findById($memberId)->first();
		return $user;
	}
	public function getConnected(){
		
		$connected = $this->request->session()->read('Auth')['User']['id'];
		return $connected;
	}

	public function generateCommunityIcons($communityId){
		$this->loadModel('Communities');
		$communityName = $this->Communities->findById($communityId)->first()['community_name'];
		$generateLink = '';

		if($communityName == 'Programming'){
			$generateLink = '<i class="fa fa-code fa-lg comm-icon"></i>';
		}
		elseif($communityName == 'Gospel'){
			$generateLink = '<i class="fa fa-book fa-lg comm-icon"></i>';
		}
		elseif($communityName == 'Business'){
			$generateLink = '<i class="fa fa-cart-arrow-down fa-lg comm-icon"></i>';
		}
		else{
			$generateLink = '<i class="fa fa-group fa-lg comm-icon"></i>';
		}
		return $generateLink;

	}
	public function countMembers($communityId){
		$this->loadModel('CommunityMembers');
		$countAll = $this->CommunityMembers->find()->where(['id_community' => $communityId])->count();
		
		return $countAll;

	}
	public function checkCommunityMembership($communityId){
		$userId = $this->request->session()->read('Auth')['User']['id'];
		$checks = $this->CommunityMembers->find()->where(['member_id' => $userId, 'id_community' => $communityId])->count();
		$checks = boolval($checks);
		return $checks;

	}
	public function listMembers($communityId){
		$communityId = intval($communityId);
		$lists = $this->CommunityMembers->find()->where(['id_community' => $communityId]);
		if($lists->count() > 0){
			foreach ($lists as $memberInfo) {
				$memberInfos = $this->getMemberInfos($memberInfo->member_id);
				$memberInfos->id == $this->getConnected() ? $memberInfos->name = 'You' 
				: $memberInfos->name = $memberInfos->name;
				
				echo '<img src="/img/'.$memberInfos->avatar.'" class="user-avatar-xs"/>'.$memberInfos->name.'&nbsp;&nbsp;';
			}
			
		}
		else{
			echo 'Please this community does not have members';
		}
	}
}