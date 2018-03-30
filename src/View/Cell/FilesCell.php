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
}