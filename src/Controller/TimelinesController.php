<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Chronos\Chronos;
use Cake\Event\Event;
use Cake\Http\Client\FormData;

class TimelinesController extends AppController{

	public function initialize()
	{
		//To load a flash
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Flash'); // Inclusion of the FlashComponent


	}

	public function newTimeline($targetUser = null){
        $this->loadModel('Users');
        $targetUser = intval($targetUser);
        $currentId = $this->Auth->user('id');
        $targetUser == null ? $targetUser = $currentId : $targetUser;

        $target = $this->Users->findById($targetUser)->first()['id'];
        $target == null ? $this->redirect($this->referer) : $target;
        

        if($this->request->is('post')){
            $this->loadModel('Timelines');

            $datas = $this->request->getData();
            $connect = $this->Timelines->dbConnect();
            if(!empty($datas['statusContent'])){
                
                $newStatus = $connect->newQuery()
                ->insert([
                    'poster_id','target_id','contents','created_at'
                ])
                ->into('timelines')
                ->values([
                    'poster_id' => $currentId,
                    'target_id' => $target,
                    'contents'  => $datas['statusContent'],
                    'created_at' => Chronos::parse('-7 hours')
                ])
                ->execute();


               if(!empty($datas['statusImg']['name'])){
                    $img = $datas['statusImg'];
                    
                    $fileName = $img['name'];
                    $targetFolder= 'img/timelines'.'/'.$currentId;
                    $fileExt = strrchr($fileName,'.');
                    $tmp_name = $img['tmp_name'];
                    $randomFileName = md5(uniqid(rand())).''.$fileExt;
                    $filePath = $_SERVER['DOCUMENT_ROOT'].'/'.$targetFolder;
                    $userFile = $filePath . '/' .$randomFileName;
                    if(!file_exists($filePath)){
                        mkdir($filePath, 0755, true);
                    }
                    $allowedExt = ['.png', '.jpeg','.jpg','.PNG','.JPG','.JPEG'];
                    if(in_array($fileExt, $allowedExt)){
                        if(move_uploaded_file($tmp_name, $userFile)){
                            $img_url = 'timelines/'.$currentId. '/'.$randomFileName;
                            $relatedTimeline = $this->Timelines->find()->where(['poster_id' => $currentId])->last()['id'];
                            
                            $newTmnImg = $connect->newQuery()
                            ->insert(['related_tmn','img_url'])
                            ->into('timelines_images')
                            ->values([
                                'related_tmn' => $relatedTimeline,
                                'img_url' => $img_url
                            ])
                            ->execute();
                            
                        }
                        else{
                            $this->Flash->warning(__('The file could not be uploaded'));
                            return $this->redirect($this->referer());
                        }
                    }
                    else{
                        $this->Flash->warning(__('Not allowed extension!'));
                        return $this->redirect($this->referer());
                    }
                    
                }
                $this->Flash->error('posted successfully');
                return $this->redirect($this->referer());
                

            }
            else{

                $this->Flash->error('please you can\'t post an empty post');
                return $this->redirect($this->referer());
            }
            

        }
        else{
            return $this->redirect($this->referer());
        }

    }
    public function starTimeline($tmnId = null){

    	$tmnId = intval($tmnId);
    	$this->loadModel('Timelines');
    	$this->loadModel('Users');
    	$connect = $this->Timelines->dbConnect();

    	$userId = $this->Auth->user('id');

    	$checkStar = $this->Timelines->TimelineStars->find()->where(['user_id' => $userId, 'r_timeline' => $tmnId])->count();

    	if(!$checkStar){
    		
    		$connect->insert('timeline_stars', [
    			'user_id' => $userId,
    			'r_timeline' => $tmnId
    		]);

    		die("star added");
    	}
    	else{
    		$this->loadModel('TimelineStars');
    		$connect->newQuery()->delete()->from('timeline_stars')->where([
    			'user_id' => $userId,
    			'r_timeline' => $tmnId
    		])->execute();
    		die("star removed");
    	}



    }

    public function newComment($tmnId = null){
    	$tmnId = intval($tmnId);
    	$this->loadModel('Timelines');
    	$connect = $this->Timelines->dbConnect();
    	$comment = $this->request->getData()['comment'];
    	$creater = $this->Auth->user('id');

		$checkRelated = $this->Timelines->findById($tmnId)->count();
		$result = "";
		if($checkRelated){
			if(mb_strlen($comment) > 5){
				$connect->insert('timeline_comments', [
					'poster_id'  => $creater,
					'content'    => $comment,
					'r_timeline' => $tmnId
				]);

				$result = $comment;
			}
			else{
				$result = "Please comment too short";
			}
			
		}
		die('');
    }
    
}