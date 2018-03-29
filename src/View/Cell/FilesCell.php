<?php
namespace App\View\Cell;
use Cake\View\Cell;
use Cake\Filesystem\Folder;
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
}