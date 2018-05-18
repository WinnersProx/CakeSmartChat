<?php

namespace App\Shell\Task;
use Cake\Console\Shell;

class SoundTask extends Shell{

	public function main(){
		$this->out("This is a sound made by WinnersProx!!!");
	}
}