<?php

namespace App\Shell\Task;
use Cake\Console\Shell;
class SeaShell extends Shell{

	// located to src/Shell/Task/SoundTask.php
	public $tasks = ['Sound'];

	public function main(){
		$this->Sound->main();
	}
}
 