<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Http\Client\FormData;
use Cake\Chronos\Chronos;
use Cake\Cache\Cache;
use Cake\FileSystem\Folder;
use Cake\FileSystem\File;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class ProfilesController extends AppController
{
    /*Loading Js component*/
    //public $helpers = ['Js' => ['Jquery']];
    
    public $paginate = [
        
        'limit' => 5, 
        'order' => [
            'Timelines.id' =>  'DESC',
        ]

    ]; 

    public function initialize()
	{
		//To load a flash
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash'); // Inclusion of the FlashComponent


	}
    public function u($userName = null){
        
        $this->loadModel('Users');
        $currentUserSlug = $this->Auth->user('slug');
        $userName == null ? $userName = $currentUserSlug : $userName;
        $checkProfile = $this->Users->findBySlug($userName)->firstOrFail();
        Cache::write('userInfos', $checkProfile);
        $userInfos = Cache::read('userInfos');

        $this->set(compact('userInfos'));
     
    }

    
    public function home(){
        $userInfos = Cache::read('userInfos');
        if($userInfos == false){
            return $this->redirect($this->referer());
        } 
        $this->loadModel('Timelines');
        $timelines = $this->paginate($this->Timelines);

        $this->set(compact('timelines'));
        $this->set(compact('userInfos'));

    }
    public function pictures(){
        $userInfos = Cache::read('userInfos');
        //about the pictures being the purpose of this action
        //about files
        
        if($userInfos == false){

            return $this->redirect($this->referer());
        } 

        $this->set(compact('userInfos'));

    }
    public function friends(){
        $userInfos = Cache::read('userInfos');
        if($userInfos == false){

            return $this->redirect($this->referer());
        } 

        $this->set(compact('userInfos'));
        
    }
   
    

        
}
