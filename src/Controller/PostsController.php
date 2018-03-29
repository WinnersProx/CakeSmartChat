<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Http\Client\FormData;

class PostsController extends AppController{
	public function plists(){

	}
	
	public function newPost(){
		$this->loadModel('Users');
		$sessionUser = $this->Auth->user('id');
		$connect = $this->Posts->dbConnect();
		if($this->request->is('post')){
			$datas = $this->request->getData();
			$content = $datas['newpost'];
			$postImg = $datas['imgFile'];
			$privacy = $datas['privacy'];
			
			if(strlen($content) >= 5){
				if(isset($privacy)){
					$privacy = $privacy;
				}
				else{
					$privacy = 0;
				}
				$post = $connect->newQuery()
				->insert(['post_owner','content', 'privacy'])
				->into('posts')
				->values(['post_owner' => $sessionUser, 'content' =>$content, 'privacy' => $privacy])
				->execute();
				if($post){
					$lastId = $this->Posts->find()->last()['id'];
					if(isset($datas['tagFriend'])){
						$tags = $datas['tagFriend'];	
						foreach ($tags as $tag) {

							$newTag = $connect->newQuery()
							->insert(['tag_id', 'r_post'])
							->into('post_tags')
							->values(['tag_id' =>$tag, 'r_post' => $lastId])
							->execute();
						}
					}
					if(isset($postImg)){
						foreach($postImg as $sImg){
		            	//Now to download my avatar
		                $file = $sImg;
		                $fileName = $file['name'];
		                $targetFolder= 'img/posts'.'/'.$sessionUser;
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
		                    	$post_url = 'posts/'.$sessionUser. '/'.$randomFileName;
		                        $postImgs = $connect
		                        ->newQuery()
		                        ->insert(['r_post', 'img_url'])
		                        ->into('post_images')
		                        ->values(['r_post' => $lastId, 'img_url' => $post_url])
		                        ->execute();
		                    }
		                    else{
		                        $this->Flash->warning(__('The file could not be uploaded'));
		                    }
		                }
		                //type not allowed
		            	}
					}
					$this->redirect(['controller' => 'users', 'action' => 'timeline']);
				}
				else{
					$this->Flash->error(__('The post could not be added try again!'));
					$this->redirect(['controller' => 'users', 'action' => 'timeline']);

				}

			}
			else{

				$this->flash->error(__('The post could not be uploaded'));
				$this->redirect(['controller' => 'users', 'action' => 'timeline']);
			}
		}
		
	}
	public function likePost($postId = null){

		$sessionUser = $this->Auth->user('id');
		$postId = intval($postId);

		$connect = $this->Posts->dbConnect();
		$checkPost = $this->Posts->findById($postId)->first();
		$checkPost = boolval($checkPost);
		if($checkPost){
			$checkStar = $connect->newQuery()
			->select('*')->from('post_likes')
			->where(['r_user_id' => $sessionUser, 'r_post_id' => $postId])
			->execute()->rowCount();
			$checkStar = boolval($checkStar);
			if(!($checkStar)){
				$newStar = $connect->newQuery()
				->insert(['r_user_id', 'r_post_id'])
				->into('post_likes')
				->values(['r_user_id' => $sessionUser, 'r_post_id' => $postId])
				->execute();
			}
			else{
				die('Just liked');
			}
			
		}
		else{
			die("The entered post does not exist");
		}
		if(!($this->request->is('ajax'))){
			$this->redirect(['controller' => 'Users', 'action' => 'timeline']);
		}

	}
	public function dislikePost($postId = null){

		$sessionUser = $this->Auth->user('id');
		$postId = intval($postId);

		$connect = $this->Posts->dbConnect();
		$checkPost = $this->Posts->findById($postId)->first();
		$checkPost = boolval($checkPost);
		if($checkPost){
			$checkStar = $connect->newQuery()
			->select('*')->from('post_likes')
			->where(['r_user_id' => $sessionUser, 'r_post_id' => $postId])
			->execute()->rowCount();
			$checkStar = boolval($checkStar);
			if($checkStar){
				$disLike = $connect->newQuery()
				->delete()
				->from('post_likes')
				->where(['r_user_id' => $sessionUser, 'r_post_id' => $postId])
				->execute();

			}
			else{
				die('This like does not exist');
			}
		}
		else{
			die("The entered post does not exist");
		}
		if(!($this->request->is('ajax'))){
			$this->redirect(['controller' => 'Users', 'action' => 'timeline']);
		}

	}
	public function commentPost($postId = null){

		$sessionUser = $this->Auth->user('id');
		$postId = intval($postId);
		$connect = $this->Posts->dbConnect();
		$checkPost = $this->Posts->findById($postId)->first();
		$checkPost = boolval($checkPost);
		$content = $this->request->getData()['content'];
		if($checkPost){
			if(mb_strlen($content) >= 2){
				$newComment = $connect->newQuery()
				->insert(['r_post_id','r_user_id', 'c_text'])
				->into('comments')
				->values(['r_post_id' => $postId, 'r_user_id' => $sessionUser, 'c_text' => $content])
				->execute();
			}
			else{
				$error = 'Too short please!';
			}
			
		}
		else{
			die('sorry');
		}
		if(!($this->request->is('ajax'))){
			$this->redirect(['controller' => 'Users', 'action' => 'timeline']);
		}

	}

}