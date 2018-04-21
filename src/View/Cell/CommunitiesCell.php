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
	public function isAdministrator($CommunityId, $memberId){
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
	public function listMembers($communityId){
		$communityId = intval($communityId);
		$lists = $this->CommunityMembers->find()->where(['id_community' => $communityId]);
		if($lists->count() > 0){
			foreach ($lists as $memberInfo) {
				$memberInfos = $this->getMemberInfos($memberInfo->member_id);
				$memberInfos->id == $this->getConnected() ? $memberInfos->name = 'You' 
				: $memberInfos->name = $memberInfos->name;
				
				echo '<img src="/img/'.$memberInfos->avatar.'" class="user-avatar-xs"/>'.$memberInfos->name.'&nbsp;&nbsp;';
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
					$postAdds = $connect->newQuery()->select('*')->from('community_pictures')->where(['target_post' => $post->id])->execute();
					if($postAdds->count() > 0){
						$pictures = $postAdds->fetchAll('obj');
						foreach ($pictures as $picture) {
							echo '<img src="/img/'.$picture->picture_url.'" class="post-images"/>';
						}
					}
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
										<i class="fa fa-certificate"></i><i class="fa fa-caret-down"></i>
									</span>
									<ul class="dropdown-menu" role="menu" arialabelledby="communityDrop1">
										<?php if($this->isAdministrator($givenCommunity['id'], $this->getConnected()) || $this->isCreater($givenCommunity['id'], $this->getConnected())):?>
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
									<input type="submit" name="subComment" value="Share" class=" community-post-submit">
									
								</form>
								
							</div>
						</div>

						<div class="community-post-comments">
							<?php $this->getCommunityPostComments($post->id);?><br/>
						</div>
					<?php
				}	
			}
			else{
				echo "<br>No posts in this community";
			}
		}
	}
	public function getCommunityInfos($communityName){
		$this->loadModel('Communities');
		$communityInfos = $this->Communities->find()->where(['community_name' => $communityName])->first();
		return $communityInfos;

	}
	public function getPostRelatedPictures($postId){
		$this->loadModel('CommunityPosts');
		$connect = $this->CommunityPosts->connect();
		$checkPictures = $connect->select('picture_url')->from('community_pictures')->where(['target_post' => $postId])->execute();
		return $checkPictures;
	}
}