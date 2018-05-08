<?php
namespace App\View\Cell;
use Cake\View\Cell;
class CommunitiesCell extends Cell{

	public function getMemberInfos($memberId){
		$this->loadModel('Users');
		$user = $this->Users->findById($memberId)->first();
		return $user;
	}
	public function getConnected(){
		
		$connected = $this->request->session()->read('Auth')['User']['id'];
		return $connected;
	}
	public function isAdmin($CommunityId, $memberId){
		$this->loadModel('CommunityMembers');
		$checkAdmin = $this->CommunityMembers->find()->where(['id_community' => $CommunityId,'member_id' => $memberId, 'member_role' => 1])->execute()->count();
		$checkAdmin = boolval($checkAdmin);

		return $checkAdmin;

	}

	public function isCreater($CommunityId, $memberId){
		$this->loadModel('Communities');
		$checkCreater = $this->Communities->findById($CommunityId)->where(['creater_id' => $memberId])->execute()->count();
		$checkCreater = boolval($checkCreater);
		
		return $checkCreater;

	}
	public function isFriendWith($targetUser = null){
		$targetUser = intval($targetUser);
		$this->loadModel('Users');
		$sessionUser = $this->request->session()->read('Auth')['User']['id'];
		$dbb = $this->Users->connectTocake();


		if($targetUser != $sessionUser){
			$check = $dbb->newQuery()
			->select('*')
			->from('relations')
			->where(['sender_id' => $sessionUser, 'receiver_id' => $targetUser])
			->orwhere(['sender_id' => $targetUser, 'receiver_id' => $sessionUser])
			->andwhere(['status' => 1])
			->execute()
			->rowCount();
			
			return boolval($check);
		}
		else{
			return true;
		}
		
	}

	public function generateCommunityIcons($communityId){
		$this->loadModel('Communities');
		$communityName = $this->Communities->findById($communityId)->first()['community_name'];
		$generateLink = '';

		if($communityName == 'Programming'){
			$generateLink = '<i class="fa fa-code fa-lg comm-icon"></i>';
		}
		elseif($communityName == 'Gospel'){
			$generateLink = '<i class="fa fa-book fa-lg comm-icon"></i>';
		}
		elseif($communityName == 'Business'){
			$generateLink = '<i class="fa fa-cart-arrow-down fa-lg comm-icon"></i>';
		}
		else{
			$generateLink = '<i class="fa fa-group fa-lg comm-icon"></i>';
		}
		return $generateLink;

	}
	public function countMembers($communityId){
		$this->loadModel('CommunityMembers');
		$countAll = $this->CommunityMembers->find()->where(['id_community' => $communityId])->count();
		
		return $countAll;

	}
	public function checkCommunityMembership($communityId){
		$userId = $this->request->session()->read('Auth')['User']['id'];
		$checks = $this->CommunityMembers->find()->where(['member_id' => $userId, 'id_community' => $communityId])->count();
		$checks = boolval($checks);
		return $checks;

	}
	public function listCommunityMembers($communityId){
		$communityId = intval($communityId);
		$lists = $this->CommunityMembers->find()->where(['id_community' => $communityId]);
		//$acquaints = parent::cell('UserAcquaintances');
		
		if($lists->count() > 0){
			foreach ($lists as $memberInfo) {
				$memberInfos = $this->getMemberInfos($memberInfo->member_id);
				$memberInfos->id == $this->getConnected() ? $memberInfos->name = 'You' 
				: $memberInfos->name = $memberInfos->name;
				
				echo '<img src="/img/'.$memberInfos->avatar.'" class="user-avatar-xs"/>'.$memberInfos->name.'&nbsp;&nbsp;';
				//followed by some controls in html
				?>
					<span class="moreUsersTools">
						<span class="dropdown-toggle" data-toggle="dropdown" id="dopMenuII">Tools<i class="fa fa-cog"></i><i class="fa fa-caret-down"></i></span>
						<ul class="dropdown-menu" role="menu" arialabelledby="dropMenuII">
							<?php if(!$this->isFriendWith($memberInfos->id)):?>
								<li>
									<a href="/users/send-request/<?=$memberInfos->id?>"><i class="fa fa-send"></i> Friend Request</a>
								</li>
							<?php endif;?>
							<?php if($this->isCreater($communityId, $this->getConnected()) || $this->isAdmin($communityId, $this->getConnected())):?>
								<li>
									<a href="/CommunityMembers/addCommunityAdmin/<?=$communityId.'/'.$memberInfos->id?>"><i class="fa fa-plus-circle"></i> Add Administrator</a>
								</li>
								<li>
									<a href="/communitymembers/remove-member/<?= $memberInfos->id.'/'.$communityId?>"><i class="fa fa-minus-circle"></i> Delete Member</a>
								</li>
							<?php endif;?>
							<?php if($this->getConnected() == $memberInfos->id && !$this->isAdmin($communityId, $this->getConnected())):?>
								<li>
									<a href="/communitymembers/remove-member/<?= $memberInfos->id.'/'.$communityId?>"><i class="fa fa-minus-circle"></i> Leave Community</a>
								</li>
							<?php endif;?>
						</ul>

						
					</span>

				<?php
			}
			
		}
		else{
			echo 'Please this community does not have members';
		}
	}

	public function getCommunityPostComments($postId){
		$this->loadModel('CommunityPosts');

		$connect = $this->CommunityPosts->connect();
		$checkComments = $connect->select('*')->from('community_post_comments')->where(['related_post' => $postId])->execute();
		if($checkComments->count() > 0){
			$comments = $checkComments->fetchAll('obj');
			foreach ($comments as $comment) {
				$memberInfos = $this->getMemberInfos($comment->member_id);
				?>
					<img src="/img/<?= $memberInfos['avatar']?>" class="user-avatar-xs"><span class="u-name"><?= $memberInfos['name']?></span> 
					<span class="comment-texts"><?= $comment->content ?></span><br>

				<?php
			}
		}
	}

	//from posts
	public function postImages($idPost){
		$this->loadModel('Posts');
		$connect = $this->Posts->dbConnect();
		$postImgs = $connect->newQuery()
		->select('picture_url')
		->from('community_pictures')
		->where(['target_post' => $idPost])
		->execute();
		$imgCount = $postImgs->rowCount();
		$imgsList = $postImgs->fetchAll('assoc');
		if($imgCount > 0){
			$pResult = '';
			foreach ($imgsList as $imgV) {
					if($imgCount == 1)
						$img_class = 'img-responsive s-img';
					else
						$img_class = 'r-imgs';

					$pResult .= '<img src="/img/'.$imgV['picture_url'].'" class="'.$img_class.'">  ';
			}
			$pResult = trim($pResult, '  ');
			switch ($imgCount) {
				case 1:
					$img = $pResult;
					break;
				case 2 :
					//$mImg = $pResult;

					$img = '<div id="II-Post-Imgs">'.$pResult.'</div>';
					$img = preg_replace("#  #", '', $img);
					break;
				case 3:
					$pResult = trim($pResult, ' ');
					$myArray = explode('  ', $pResult);
					$lastItem = array_pop($myArray);
					$toStringf = implode('  ', $myArray);
					
					$img = '<div class="r-post-imgs-left">'.$lastItem.'</div><div class="r-post-imgs-right">'.$toStringf.'</div>';
					break;
				case 4: 
					$toArray = explode('  ', $pResult);
					$chunkArray = array_chunk($toArray, 2);
					
					$firsts = $chunkArray[0]; $firsts = implode(',', $firsts);
					$lasts = $chunkArray[1];$lasts = implode(',', $lasts);
					$img = '<span id="IV-Post-imgs-left">'.$firsts.'</span><span id="IV-Post-imgs-right">'.$lasts.'</span>';
					
					$img = preg_replace('#,#', '', $img);
					break;
				default:
					$myArray = explode('  ', $pResult);
					$chunkArray = array_chunk($myArray, 3);
					$count = $imgCount - 4;   
					$firsts = $chunkArray[0];
					$remains = $chunkArray[1];
					$toStringf = implode(',', $firsts);
					$lastOne = array_chunk($remains, 1)[0];
					$lastOne = implode(',', $lastOne);
					$img = '<span id="V-Post-imgs">'.$toStringf.'</span><span class="more-pictures">'.$lastOne.'<span class="more-pictures-text"> <i class="fa fa-plus-circle"></i> '.$count.' More Image</span></span>';

					$img = preg_replace('#,#', '', $img);
					break;
			}

			echo $img;
		}
	}
	//from posts

	public function getCommunityPosts($communityId){
		$this->loadModel('Communities');
		$connect = $this->Communities->connectTocake();
		$givenCommunity = $this->Communities->findById($communityId)->first();
		$checkCommunity = boolval($givenCommunity);
		if($checkCommunity){
			if($this->checkCommunityMembership($givenCommunity['id'])){
				$posts = $connect->newQuery()->select('*')->from('community_posts')->where(['target_community' => $givenCommunity['community_name']])->order(['id' => 'DESC'])->execute();		
			}
			else{
				echo 'Join this community to find more!!!<br/>';
				$posts = $connect->newQuery()->select('*')->from('community_posts')->where(['target_community' => $givenCommunity['community_name'], 'privacy' => 0])->order(['id' => 'DESC'])->execute();

			}
			if($posts->count() > 0){
				$posts = $posts->fetchAll('obj');
					foreach ($posts as $post) {
						$memberInfos = $this->getMemberInfos($post->member_poster);
						//the avatar of the  user who created the post
						echo '<img src="/img/'.$memberInfos['avatar'].'" class="user-avatar-xs"/> '.$memberInfos['name'].' Posted <br/>';

						echo $post->post_content.'<br/>';
						//now to get all related pictures to a given posts
						$this->postImages($post->id);
					
					
					//the interface for users to comment share and rate so on//
					?>
						<div class="member-interface">
							<span><i class="fa fa-thumbs-o-up"></i> <a href="/communityPosts/ratePost/<?= $post->id?>">Rate</a></span>
							<span>
								<i class="fa fa-comment"></i> <a href="/communities/communityComment/<?= $post->id?>">Comment</a>
							</span>
							<span>
								<i class="fa fa-share"></i> <a href="/communityPosts/shareCommunityPost/<?= $post->id ?>">Share</a> 
							</span>
							<?php if($this->checkCommunityMembership($communityId)):?>
								<span class="right tools dropdown">
									<span class="dropdown-toggle" id="communityDrop1" data-toggle="dropdown">
										<i class="fa fa-cog"></i><i class="fa fa-caret-down"></i>
									</span>
									<ul class="dropdown-menu" role="menu" arialabelledby="communityDrop1">
										<?php if($this->isAdmin($givenCommunity['id'], $this->getConnected()) || $this->isCreater($givenCommunity['id'], $this->getConnected())):?>
											<li>
												<a href="/communities/deleteCommunityPost/<?=$post->id?>">Delete</a>
											</li>
										<?php endif;?>
										<li>
											<a href="/communityPosts/shareCommunityPost/<?= $post->id ?>">Share</a>
										</li>
										
									</ul>
								</span>
							<?php endif;?>
						</div>
						<div class="member-comment">
							<div class="community-comment">
								<form action="/CommunityPosts/commentPost/<?= $post->id?>" method="post">
									<input type="text" class="community-post-comment comment-post form-control" name="mPostComment" placeholder="Put your comment right here!!!">
									<input type="submit" name="subComment" value="Comment" class=" community-post-submit">
									
								</form>
								
							</div>
						</div>
					
						<div class="community-post-comments">
							<?php $this->getCommunityPostComments($post->id);?><br/>
						</div>
					<?php
					}
				}	
			}
			else{
				echo "<br>No posts in this community";
			}
	}
	
	public function getCommunityInfos($communityName){
		$this->loadModel('Communities');
		$communityInfos = $this->Communities->find()->where(['community_name' => $communityName])->first();
		return $communityInfos;

	}
	
}