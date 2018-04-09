<?php
namespace App\View\Cell;
use Cake\View\Cell;
class CommunitiesCell extends Cell{
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
}