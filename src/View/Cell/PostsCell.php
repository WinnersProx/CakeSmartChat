<?php
namespace App\View\Cell;
use Cake\View\Cell;
use Cake\Datasource\Paginator;//for cakephp 3.5.0 please!!
use Cake\Chronos\Chronos;
use Cake\Utility\Inflector;

class PostsCell extends Cell{


	public function getCurrentUserId(){
		$this->loadModel('Users');

		$logged = $this->request->session()
			   ->read('Auth')['User']['id'];
		return $logged;
	}
	public function postLists(){
		$this->loadModel('Posts');
		//$paginator = new Paginator;
		//$posts = $paginator->paginate($this->Posts);
		$connect = $this->Posts->dbConnect();
		$listPosts = $connect->newQuery()
		->select('*')
		->from('posts')
		->order(['id' => 'DESC'])
		->execute()
		->fetchAll('obj');
		

		return $listPosts;
	}
	public function getDate($date){
		$inflector = new Inflector;
		$Chronos = new Chronos($date);
		
		$now = (new Chronos)->parse('- 7 hours');
		
		$dated = $Chronos->diffForHumans($now);
		$time = explode(' ', $dated);
		$true_date = array_chunk($time, 2)[0];
	
		$trueOne = implode(',', $true_date);
		$inflected = $inflector->slug($trueOne);
		

		return $inflected;
	}
	public function userInfo($userId){
			$this->loadModel('Users');
			$user = $this->Users->findById($userId)->first();

			
			return $user;
			
	}
	public function postImages($idPost){
		$this->loadModel('Posts');
		$connect = $this->Posts->dbConnect();
		$postImgs = $connect->newQuery()
		->select('img_url')
		->from('post_images')
		->where(['r_post' => $idPost])
		->execute();
		$imgCount = $postImgs->rowCount();
		$imgsList = $postImgs->fetchAll('obj');
		if($imgCount > 0){
			foreach ($imgsList as $img) {
				if($imgCount == 1){
					$img = '<img src="/img/'.$img->img_url.'" class="img-responsive s-img">';
				}
				else{
					$img = '<img src="/img/'.$img->img_url.'" class="img-responsive r-imgs">';
				}
				
				echo $img;
			}
		}
	}

	public function likedTag($current, $targetPost){
		$this->loadModel('Posts');
		$connect = $this->Posts->dbConnect();
		$checkTag = $connect->newQuery()
		->select('*')
		->from('post_tags')
		->where(['tag_id' => $current, 'r_post' => $targetPost])
		->execute()
		->rowCount();

		return boolval($checkTag);

	}

	public function postTags($postId){
		$this->loadModel('Posts');
		$connect = $this->Posts->dbConnect();
		$postImgs = $connect->newQuery();
		$connected = $this->getCurrentUserId();

		$listTags = $connect->newQuery()
		->select('*')
		->from('post_tags')
		->where(['r_post' => $postId])
		->execute();
		$countTags = $listTags->rowCount();
		if($countTags > 0){
			$tagLists = $listTags->fetchAll('obj');
			$tagLink = '';
			foreach ($tagLists as $tag) {

				if($tag->tag_id == $this->getCurrentUserId()){
				 	$tagged = 'You';
				 	$tagName = $this->userInfo($tag->tag_id)['slug'];
				}
				else{
					$tagged = $this->userInfo($tag->tag_id)['name'];
					$tagName = $this->userInfo($tag->tag_id)['slug'];
				}

				$tagLink .= '<a class="tags" href="/profiles/u/'.$tagName.'">'.$tagged.'</a>, ';
			}
			$tagLink = trim($tagLink, ', ');
			
			if($countTags == 2 || $countTags == 3){
				$toArray = explode(', ', $tagLink);
				$lastTag = array_pop($toArray);
				$found = implode(', ', $toArray);

				$myresult = $found.' and '. $lastTag;

			}
			$remains = $countTags - 3;
			switch ($countTags) {
				case 1:
					$result = $tagLink;
					break;
				case 2:
					$result = $myresult;
					break;
				case 3:
					$result = $myresult;
					break;
				case 4:
					$arrayList = explode(', ', $tagLink);
					$last = array_pop($arrayList);
					$final = implode(', ', $arrayList);
					$result = $final. ' and '.'<span class="remains-tags">'.$remains.' other person <i class ="fa fa-eye s-b"></i><span class="sub-tags sub fa-1x">'.$last.'</span>';
					break;
				
				default:
					$myArray = explode(', ', $tagLink);
					$divide = array_chunk($myArray, 3);
					$firstOnes = $divide[0];
					$lastOnes = $divide[1];
					$toString1 = implode(', ', $firstOnes);
					$toString2 = implode(', ', $lastOnes);

					$result = $toString1. ' and <span class="remains-tags"> '.$remains.' </span> other people <i class ="fa fa-eye sub"></i> <div class="sub-tags">'. $toString2.' </div>';
					
					break;
			}

			echo $result;

			
			
		}

	}
	public function checkUserStar($postId){
		$this->loadModel('Posts');
		$postId = intval($postId);
		$connect = $this->Posts->dbConnect();
		$connected = $this->getCurrentUserId();
		$checkStar = $connect->newQuery()->select('*')
		->from('post_likes')->where(['r_user_id' => $connected, 'r_post_id' => $postId])
		->execute()->rowCount();

		$checkStar = boolval($checkStar);
		return $checkStar;

	}
	public function countStars($postId){
		$this->loadModel('Posts');
		$postId = intval($postId);
		$connect = $this->Posts->dbConnect();
		$checkStar = $connect->newQuery()->select('*')
		->from('post_likes')->where(['r_post_id' => $postId])
		->execute()->rowCount();
		return $checkStar;
	}
	public function countComments($postId){
		$this->loadModel('Posts');
		$postId = intval($postId);
		$connect = $this->Posts->dbConnect();
		$countComments = $connect->newQuery()
		->select('*')
		->from('comments')
		->where(['r_post_id' => $postId])
		->execute()
		->rowCount();

		return $countComments;
	}
	public function renderComments($postId){
		$this->loadModel('Posts');
		$postId = intval($postId);
		$connect = $this->Posts->dbConnect();
		$listComments = $connect->newQuery()
		->select('*')
		->from('comments')
		->where(['r_post_id' => $postId])
		->execute()
		->fetchAll('obj');
		foreach ($listComments as $comment) {
			$uInfos = $this->userInfo($comment->r_user_id);
			$name = $uInfos['name'];
			$avatar = $uInfos['avatar'];

	   echo '<div class="comments-info">
				<div class="user-photo">
					<img src="/img/'.$avatar.'" class="user-avatar-xs"/>
				</div>
				<div class="users-comments">
					<span class="comment-texts">
						<span class="u-name"> '.$name.'</span> '.h($comment->c_text).'</span>
						</span>
				</div>
								
			</div>';
		}
	}

}
