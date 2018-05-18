<?php

	namespace App\Shell;
	use Cake\Console\Shell;

	class HelloShell extends Shell
	{
		//for tasks
		public $tasks = ['Template'];

		public function initialize()
		{
			parent::initialize();
			$this->loadModel('Users');
			$this->loadModel('Notifications');
			$this->loadComponent('Auth');
		}
		public function main()
		{
			$this->out('Hello world.');
		}
		public function testq(){
			$this->out('Quiet message', 1, Shell::QUIET);
			$this->quiet('Quiet message');
			// n'apparaitra pas quand une sortie quiet est togglé
			$this->out('message normal', 1, Shell::NORMAL);
			$this->out('message loud', 1, Shell::VERBOSE);
			$this->verbose('Verbose output');
		}

		public function greeting($name = null)
		{
			$names = $this->Users->find();
			//user input
			$yours = $this->in("Please specify your name :", ['Winner', 'Vainqueur'], 'WInner');
			$this->out("Welcome ". $yours. " !<br>");
			foreach ($names as $name) {
				$this->out("Evening " . $name['name']);
			}
			#horizontal lign
			$this->hr();
			$this->out('Counting down');

			$this->out('10', 0);
			//to ovewrite something on the screen
			for ($i = 10; $i > 0; $i--) {
				sleep(4);
				$this->_io->overwrite($i, 0, 2);
			}

			
		}
		public function notify(){

			//App::import('Component','Auth'); 
        	//$this->Auth = new AuthComponent(null); 

			$datas = [
				'user_id' => 2,
				'content' => 'new notification!!!'

			];
			$entity = $this->Notifications->newEntity();

			$newLine = $this->Notifications->patchEntity($entity, $datas);
			
			if($this->Notifications->save($newLine)){
				$this->out("a new line has been recorded");
			}
			else{
				$this->out("unable to insert via shell");
			}
		}

		public function display(){
			if(empty($this->args[0]))
			{
				$this->abort("Please try to add a name!!");
			}
			$name = $this->Users->findById($this->args[0])->first();
			$this->out(print_r($name, true));
		}
	}