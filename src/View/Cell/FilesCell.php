<?php
namespace App\View\Cell;
use Cake\View\Cell;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
class Filescell extends Cell{
	public function getAllpngFiles(){
		$dir = new Folder(WWW_ROOT . 'img/avatars/2');
		$files = $dir->find('.*\.jpg', true);
		$i = 0;
		$chunkArray = array_chunk($files, 6)[0];
		foreach ($chunkArray as $file) {
			echo '<div class="s-picture">
					<img src="/img/avatars/2/'.$file.'" class="img-rounded">
				 </div>';

		}
	}
	public function getUserAvatars($userId = null){
		$userId = intval($userId);
		$this->loadModel('Users');
		$directory = new Folder(WWW_ROOT.'img/avatars/'.$userId);
		
		if($directory->path == null){
			$userAvatarDef = $this->Users->findById($userId)->first()['avatar'];
			echo '<div class="s-picture">
					<img src="/img/'.$userAvatarDef.'" class=" user-avatar-img"/>
					<span class="avatar-message">
						Actually no avatar please add one for people to recognize you
				    </span>
				  </div>
				  
				   ';
		}
		else{
			$myAvatars = $directory->find('.*\.*',true);
		
			$getFirsts = array_chunk($myAvatars, 6)[0];

			foreach ($getFirsts as $userAvatar) {
				$file = new File($directory->pwd().DS.$userAvatar);
				$path = '/avatars/'.$userId.'/'.$userAvatar;
				echo '<div class="s-picture">
						<img src="/img'.$path.'" class=" user-avatar-img"/>
					  </div>';

				$file->close();
			}


		}
		

	}

	public function generateGalleryCover($galeryUrl = null){
		$GaleryDirectory = new Folder(WWW_ROOT.$galeryUrl);
		$imgs = $GaleryDirectory->find('.*\.*',true);
		$last = array_pop($imgs);
		return $last;
		
	}
	public function countavailable($galeryUrl = null){
		$GaleryDirectory = new Folder(WWW_ROOT.$galeryUrl);
		$imgs = $GaleryDirectory->find('.*\.*',true);
		$countImgs = count($imgs);
		return $countImgs;
	}
	public function countCommunityImgages($userId = null){
		$this->loadModel('CommunityPosts');
		$cImgs= $this->CommunityPosts->find()->where(['member_poster' => $userId])->count();
		return $cImgs;
	}
	public function getCommunityImages($userId = null){
		$this->loadModel('CommunityPosts');
		$this->loadModel('CommunityPictures');

		// ♦♦ to reformulate not far for it is like disorder ♦♦

		$query = $this->CommunityPosts->find()->contain('CommunityPictures')->where(['member_poster' => $userId])->last();
		
		$lastImg = $query->community_pictures[0]->picture_url;
		return $lastImg;
		
	}
	public function countTimelineImgs($userId = null){
		$this->loadModel('Timelines');
		$this->loadModel('TimelinesImages');
		$countTmlns = $this->Timelines->find()->contain('TimelinesImages')->where(['target_id' => $userId])->count();
		return $countTmlns;
	}
	public function getlastTimelineImg($userId = null){
		$this->loadModel('Timelines');
		$this->loadModel('TimelinesImages');
		$lastTmln = $this->Timelines->find()->contain('TimelinesImages')->where(['target_id' => $userId])->last();
		$last = $lastTmln->timelines_images[0]->img_url;

		return $last;
	}

	public function countUserPosts($userId = null){
		$this->loadModel('Posts');
		$this->loadModel('PostImages');
		$countposts = $this->Posts->find()->contain('PostImages')->where(['post_owner' => $userId])->count();

		return $countposts;
	}
	public function getlastPostImg($userId = null){
		$this->loadModel('Posts');
		$this->loadModel('PostImages');
		$lastPost = $this->Posts->find()->contain('PostImages')->where(['post_owner' => $userId])->last();
		$last = $lastPost->post_images[0]->img_url;

		return $last;
	}

}