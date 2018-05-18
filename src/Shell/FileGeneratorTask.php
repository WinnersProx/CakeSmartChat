<?php
	namespace App\Shell\Task;
	use Cake\Console\Shell;
	class FileGeneratorTask extends Shell
	{
		public function main()
		{
			$this->out("I am the main one");
		}
	}