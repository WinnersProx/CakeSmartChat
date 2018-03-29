<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Http\Client\FormData;
use Cake\Chronos\Chronos;

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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    /*To allow some pages to be accessed without Authentification*/       
    public function initialize()
	{
		//To load a flash
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash'); // Inclusion of the FlashComponent


	}
    public function u($userName = null){
        $this->loadModel('Users');
        $loggedIn = $this->request->session()->read('Auth');
        $currentUserSlug = $loggedIn['User']['slug'];

        $userName == null ? $userName = $currentUserSlug : $userName;
        $checkProfile = $this->Users->findBySlug($userName)->firstOrFail();
        $userInfos = $checkProfile;
        $this->set(compact('userInfos'));
     
    }
    

        
}
