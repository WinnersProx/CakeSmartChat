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
class UsersController extends AppController
{
    /*Loading Js component*/
    //public $helpers = ['Js' => ['Jquery']];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    /*To allow some pages to be accessed without Authentification*/   

    public $paginate = [
        
        'limit' => 5, 
        'order' => [
            'Posts.id' =>  'DESC'
        ]

    ]; 
    
    public function beforeFilter(Event $event){
    	$this->Auth->allow(['signup','forgotPassword']);

    }
    public function initialize()
	{
		//To load a flash
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash'); // Inclusion of the FlashComponent
        


	}
    public function index()
    {
        $users = $this->paginate($this->Users);
        $opts = $this->Users->find('list');
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
     public function sendRequest($id = null)
    {
        dd($this->request);
        $db = $this->Users->connectTocake();
        $connectedId = $this->Auth->user('id');
        if(isset($id)){
            $id = intval($id);
            $checkUser = $this->Users->findById($id)->first()['id'];
            if($checkUser){
            $userExist = $db->newQuery()
            ->select('*')
            ->from('relations')
            ->where(['sender_id' => $connectedId,'receiver_id' => $id])
            ->orwhere(['receiver_id' => $connectedId,'sender_id' => $id]);
            $userExec = $userExist->execute();
            $userCount = $userExec->rowCount();
            $userFound = $userExec->fetch('obj');  
            //Test the count to know if an invitation is just sent
            if($userCount < 1){
                $q = $db->newQuery()
                ->insert(['sender_id','receiver_id'])
                ->into('relations')
                ->values(['sender_id' => $connectedId, 'receiver_id' => $id])
                ->execute();
                $success = "Invited";
                $msg = "has sent you an invitation"; 
                $object = "request";
                $newNotif = $db->newQuery()
                ->insert(['user_id','target_user','content','object'])
                ->into('notifications')
                ->values(['user_id' => $connectedId, 'target_user' => $id, 'content' => $msg, 'object' => $object])
                ->execute();
            }
            else{
                if($userFound->sender_id == $connectedId){
                    $success = "Just sent";
                }
                else{
                    $success = "Confirm!";
                }
                
            }

        }
        else{
            $success = "wrong!";
        }
        }
        else{
            $success = "wrong!";
        }
        
        
        
        $this->set(compact('success'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        
        if(!$id){
            $this->Flash->warning(__('Please you must have an id to access the Profile page!'));
            return $this->redirect(['action' => 'index']);
        }
        $sessionInf = $this->request->session()->read('Auth');
        $curUser = $sessionInf['User']['id'];
        if($id != $curUser){
            $this->Flash->warning(__('Please The specified profile is not yours!'));
            return $this->redirect(['action' => 'view', $curUser]);
        }

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
    //For signing up
    public function signup()
    {
        
        if($this->request->session()->read('Auth')){
            $this->Flash->warning(__('You are not allowed to access this page,logout first!'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $user = $this->Users->patchEntity($user, $data);
            if($this->Users->save($user)){
                $this->Flash->success(__('The user has been saved.Edit your profile here Login now!'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function login()
    {
        $Time = Chronos::parse('- 7 hours');
    	$user = $this->Users->newEntity();
    	$mail = $this->request->getData();
    	//To check if the user is logged in so that he may not loggin twice
    	if($this->Auth->user('id')){
    		$this->Flash->warning('Please you are just logged in!');
    		return $this->redirect(['action' => 'index']);
    	}
    	//To check if the user is logged in so that he may not loggin twice
    	if($this->request->is('post')){
    		$user = $this->Auth->identify();
    		//$qr = $this->Users->find('Users.name')->where(['email' => $query['email']]);
    		if($user){
    			$this->Auth->setUser($user);
                //checks if the user does not exist in our table
                $authId = $this->Auth->user('id');
                $userIp = $this->request->env('REMOTE_ADDR');
                $dB = $this->Users->connectTocake();
                $checkLive = $dB->newQuery()
                ->select('user_id')
                ->from('live_users')
                ->where(['user_id' => $authId])
                ->execute()
                ->rowCount();
                $checkLive = boolval($checkLive);
                if($checkLive){
                    $updateStatus = $dB->newQuery()
                    ->update('live_users')
                    ->set(['live_status' => 1, 'created_at' => $Time])
                    ->where(['user_id' => $authId])
                    ->execute();
                }
                else{
                    $newLive = $dB->newQuery()
                    ->insert(['user_id', 'user_ip', 'created_at', 'live_status'])
                    ->into('live_users')
                    ->values([
                        'user_id' => $authId,
                        'user_ip' => $userIp,
                        'created_at' => $Time,
                        'live_status' => 1

                    ])
                    ->execute();


                }
                //checks if the user does not exist in our table
    			
    			$this->Flash->success('Welcome '.$user['name'].' Feel free you are at yours!');
    			return $this->redirect($this->Auth->redirectUrl());
    			//return $this->redirect($this->referer());
    		}
    		$this->Flash->error(__('Your username or password is invalid'));
    	}
    	$this->set(compact('user'));
        
    }
    public function timeline(){


        $this->loadModel('Posts');
        $posts =  $this->paginate($this->Posts->find());
        
        $sessionUser = $this->Auth->user('id');

        if($sessionUser){

            $dbb = $this->Users->connectTocake();//My function to connect to database named cake
           // for the loggedin uesr now
            $connected = $this->Users->find()->where(['id' => $sessionUser])->first();
            
        }
        else{
            $this->Flash->warning(__('Please you are not allowed to see this page!'));
            $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        
        $this->set(compact('connected'));
        $this->set([
            'posts' => $posts,
            'recipe'    => $posts,
            ['_serialize']
        ]);
         
    }
    public function profile($userName = null){
        
        $passed = $this->request->pass[0];
        
        $loggedIn = $this->request->session()->read('Auth');
        $id = $this->request->query('id');
        $sessionUser = $loggedIn['User']['id'];
        if(!(isset($passed))){
            $this->Flash->error('Not Found!');
            $this->redirect(['action' => 'timeline']);
        }
        if($sessionUser){
            

            $dbb = $this->Users->connectTocake();//My function to connect to database named cake
            $idLogged = $id;
            $acquaintances = $dbb->newQuery()
            ->select(['id,name,avatar'])
            ->from('users')
            ->where(['id <>' => $sessionUser])
            ->execute()
            ->fetch('assoc');
            
            
            $userName = $dbb->newQuery()
            ->select('*')
            ->from('users')
            ->where(['id' => $idLogged])
            ->execute()
            ->fetch('assoc');
            
            $connected = $dbb->newQuery()
            ->select('*')
            ->from('users')
            ->where(['id' => $sessionUser])
            ->execute()
            ->fetch('assoc');
        }
        else{
            $this->Flash->warning(__('Please you are not allowed to see this page!'));
            $this->redirect(['controller' => 'Users', 'action' => 'timeline', 'id' => $sessionUser]);
        }

         $this->set(compact('connected'));
         $this->set(compact('acquaintances'));
         $this->set(compact('loggedIn'));

    }
    public function logout(){
        $Time = Chronos::parse('- 7 hours');
        $authId = $this->Auth->user('id');
        $dB = $this->Users->connectTocake();
        //disconnect from live users
        $updateStatus = $dB->newQuery()
        ->update('live_users')
        ->set(['live_status' => 0, 'created_at' => $Time])
        ->where(['user_id' => $authId])
        ->execute();
        //disconnect from live users;
    	$this->Auth->logout();
    	$this->Flash->success(__('You have been logged out!')); 
    	return $this->redirect(['controller' => 'Users','action' => 'login']);
    }
    public function forgotPassword(){
       $this->redirect(['action' => 'timeline']);
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $connectedUser = $this->Auth->user('id');
        $id = intval($id);
        $id != $connectedUser ? $id = $connectedUser : $id = $id;
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Profile Updated Successfully'));

                return $this->redirect(['controller' => 'users', 'action' => 'timeline']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function notifications(){
        $loggedIn = $this->request->session()->read('Auth');
        $sessionUser = $loggedIn['User']['id'];
        $db = $this->Users->connectToCake();

        $nbrNotif = $db->newQuery()
        ->select('*')
        ->from('notifications')
        ->where(['target_user' => $sessionUser,'status' => 0]);
        $result = $nbrNotif->execute();
        $count = $result->rowCount();
        $this->set(compact('count'));
    }
    public function notificationsList(){
        $loggedIn = $this->request->session()->read('Auth');
        $sessionUser = $loggedIn['User']['id'];
        $db = $this->Users->connectToCake()->newQuery();
        $notifs = $db->select('user_id,content,object,u.name,u.avatar,r.status,target_user')
        ->from('notifications')
        ->join([
            'table' => 'users',
            'alias' => 'u',
            'type' =>  'RIGHT',
            'conditions' => 'u.id = notifications.user_id'
        ])
        ->join([
            'table' => 'relations',
            'alias' => 'r',
            'type' =>  'LEFT',
            'conditions' => 'r.receiver_id = u.id'
        ])
        ->where(['target_user' => $sessionUser])
        ->execute();
        $nbrNotifs = $notifs->rowCount();

        $notifications = $notifs->fetchAll('obj');
        $empty = 'no new notifications';
        $this->set(compact(('notifications')));
        $this->set(compact(('nbrNotifs')));
        $this->set(compact(('empty')));
    }
    public function confirm($sender = null, $receiver = null){

        $dbm = $this->Users->connectToCake()->newQuery();
        $userInfo = $this->request->session()->read('Auth');
        $currentUser = $userInfo['User']['id'];
        $sender = intval($sender);
        $receiver = intval($receiver);
        if(isset($sender) && isset($receiver)){
            if($receiver != $currentUser){
                $receiver = $currentUser;
            }

            $checkRelation = $dbm->select('sender_id,receiver_id')
            ->from('relations')
            ->where(['sender_id' => $sender,'receiver_id' => $receiver])
            ->execute();
            $result = $checkRelation->rowCount();
            if($result == 1){
                $confirm = $dbm->update('relations')
                ->set(['status' => 1])
                ->where(['sender_id' => $sender])
                ->andwhere(['receiver_id' => $receiver]) 
                ->execute();
                $content = 'has accepted your invitation';
                $response = 'Friend';
                $notif = $dbm->insert(['user_id','target_user','content'])
                ->into('notifications')
                ->values(['user_id' => $receiver,'target_user' => $sender, 'content' => $content])
                ->execute();
                $this->set(compact('response'));

            }
            else{
                $this->Flash->warning(__('Wrong request! Try again'));
            }
            

        }
        else{
        }
    }
    public function avatarUpload(){

        if($this->request->is('post')){
            $avatar = $this->request->getData()['userAvatar'];
            $sessionUser = $this->Auth->user('id');
            $connect = $this->Users->connectTocake();
            if(isset($avatar)){
                        
                //Now to download my avatar

                $file = $avatar;
                $fileName = $file['name'];
                $targetFolder= 'img/avatars'.'/'.$sessionUser;
                $fileExt = strrchr($fileName,'.');
                $tmp_name = $file['tmp_name'];
                $randomFileName = md5(uniqid(rand())).''.$fileExt;
                $filePath = $_SERVER['DOCUMENT_ROOT'].'/'.$targetFolder;
                $userFile = $filePath . '/' .$randomFileName;
                if(!file_exists($filePath)){
                    mkdir($filePath, 0755, true);
                }
                $allowedExt = ['.png', '.jpeg','.jpg','.PNG','.JPG','.JPEG'];
                if(in_array($fileExt, $allowedExt)){
                    if(move_uploaded_file($tmp_name, $userFile)){
                        $avatar_url = 'avatars/'.$sessionUser. '/'.$randomFileName;
                        $postImgs = $connect
                        ->newQuery()
                        ->update('users')
                        ->set(['avatar' => $avatar_url])
                        ->where(['id' => $sessionUser])
                        ->execute();
                    }
                    else{
                        $this->Flash->warning(__('The file could not be uploaded'));
                    }
                }
            }
            else{
                die('Sorry no file');
            }

        }
        
        
        
        

    }

        
}
