<?php
	$usersEvents = $this->cell('UsersEvents');

?>
<div class="user-event">
<?php if($usersEvents->checkUserBirthDay($LoggedUser['User']['id'])):?>
	<div class="flash-render">
		<span class="flash"><?= $this->Flash->render()?></span>
			<div class="text-center" class="u-birthDay">
				Happy Birth Day <?= $LoggedUser['User']['name']?>
			</div>
	</div>
<?php endif;?>
</div>
<div class="post">
	<div id="post-baker">
		<span class="post-title badge"><i class="fa fa-edit"></i> Edit a new post!</span>
		<form method="post" enctype="multipart/form-data" action="/posts/newPost">
			<textarea name="newpost" placeholder="What's up <?= $connected['name']?>!" class="content" rows="2" required="required" id="p-content-text"></textarea>
			<div class="bottom-menu">
				<!--to append the modal -->
				<div class="post-validator" data-toggle="modal" data-target="#poster-modal">
					<i class="fa fa-check-circle fa-lg"></i>
				</div>
				<!--End to appending the modal-->

				<!--to upload a picture -->
				<div id="liveImageUpload" data-toggle="modal" data-target="#liveImg"><i class="fa fa-camera fa-lg"></i></div>
			</div>

			<div class="modal fade" id="liveImg" tabindex="-1">
				<div class="modal-dialog" id="pictureBakerM">
					<div class="modal-content">
						<div class="modal-header">
							<span class="modal-title">New live Image from <?= $connected['name']?></span>
							<span class="close closeImage" data-dismiss="modal" aria-hidden="true"> &times; </span>
						</div>
						<div class="modal-body">
							<div class="img-controllers">
								<video id="myWebmedia" width="400" height="400"></video>
								<canvas id="canvas" width="400" height="400"></canvas>
								<img id="preview" src=""/>
							</div>
						</div>
						<div class="modal-footer">
							<span class=" btn btn-default f-saver" id="StartLiveImage">Start</span>
							<span class=" btn btn-default f-saver" id="captureImg">Take Picture</span>
							<span class=" btn btn-default f-saver closeImage">Close</span>
						</div>
						
					</div>
					
				</div>
				
			</div>
			<!-- to upload a picture -->
			<div class="modal fade" tabindex="-1"  id="poster-modal">
				<div class="modal-dialog" id="postModal">
					<div class="modal-content">
						<div class="modal-header postModalHeader">
							<span class="modal-title">New Post From <?= $connected['name']?></span>
							<span class="close" data-dismiss="modal" aria-hidden="true"> &times; </span>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-7">
									<span class="badge post-opts"><i class="fa fa-font"></i> Post Content </span>
									<div class="post-text">
									</div>
									<br/>
									<div class="post-images">

										<span class="badge post-opts"><i class="fa fa-picture-o"></i> Post Images</span> 
										<div class="img-transfer">
											<input type="file" name="imgFile[]" class="img-upload" multiple="multiple">
											<span >
							                    <span class="post-img-baker custom-baker">
							                    <i class="fa fa-upload"></i> Pictures
							                    </span>
						                  	</span>
										</div>
										<div class="img-preview uploader-text">
											<i>None selected!</i>
										</div>
										
									</div>
								</div>
								<div class="col-md-5">
									<span class="badge post-opts"> <i class="fa fa-certificate"></i>Post Options</span><br/>
									<div id="post-options">
										<span class="badge post-opts-bdg tag">Tag with</span><span class="badge post-opts-bdg privacy">Post privacy</span><br>
										<!-- for my tags-->
										<div class="tag-infos">
											<?php
												$this->cell('UserFriends')->getUserFriends($LoggedUser['User']['id']);
											?>
										</div>
										
										<!--for my tags-->
										
										<!--for my privacy infos-->
										<div class="privacy-infos">
											<input type="radio" name="privacy" value="2"> Public<br>
											<input type="radio" name="privacy" value="1">  Friends<br>
											<input type="radio" name="privacy" value="0" checked>  Private<br>
										</div>
										<!--for my privacy infos-->
									</div>	
								</div>
								
							</div>
							
							<div class="poster">

							</div>	
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-default submit-b" name="new"><i class="fa fa-edit fa-lg"></i> New Post</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>	
</div>
<div id="post-infos">
	<?php 
			$postsCell = $this->cell('Posts');

	?>
	<?php foreach($posts as $post):?>
	<div class="post-lists">
		
		
		<div class="t-post-lists">
			<!-- here-->
			<div class="dropdown align-items-baseline right" id="postDropMenu">
				<a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
					<span class="customized-toggler">
						<i class="fa fa-circle-o"></i>
						<i class="fa fa-circle-o"></i>
						<i class="fa fa-circle-o"></i>
					</span>
				</a>
					
				<div class="dropdown-menu">
					<a class="dropdown-item"><i class="fa fa-minus-circle"></i> Delete Post</a>
					<a class="dropdown-item"><i class="fa fa-share"></i> Share Post</a>
					<a class="dropdown-item" href=""><i class="fa fa-expand"></i> View More</a>

				</div>
			</div>

			<!--here-->
			<?php $Uinfos = $postsCell->userInfo($post->post_owner);?>
			<img src="/img/<?= $Uinfos['avatar'] ? $Uinfos['avatar'] : '/userdefault.png';?>" 
			class="user-avatar-md">
			<span class="poster-text">
				<a href="/profiles/u/<?= $Uinfos['slug'] ?>"><?= $Uinfos['name']?></a>
				<span class="dated">posted in last <?= $postsCell->getDate($post->date_from);?> 
				</span>

			</span>
			<span class="tags">
				with <?php $postsCell->postTags($post->id);?>
			</span>
			<!--post t-menus replaced removed-->
			<div class="post-content-text">
				<?= $post->content ?>
			</div>
			 
			<div class="post-contents-show">
				<div class="post-images">
				<?php $postsCell->postImages($post->id);?>
				</div>
				<div class="posts-interaction-bar">
					<span class="p-int star">
					<?php if($postsCell->checkUserStar($post->id)):?>
						<span class="p-interaction p-star"  data-mix-star="unstar-<?=$post->id?>">
								<i class="fa fa-star"></i> 
								<span class="ch-text">Unstar</span>
								(<span class="ch-count"><?= $postsCell->countStars($post->id)?></span>)

						</span>	
					<?php else:?>
						<span class="p-interaction p-star" data-mix-star="star-<?=$post->id?>">
							<i class="fa fa-star-o fa-rotate-180"></i> <span class="ch-text">Star</span>
							(<span class="ch-count"><?= $postsCell->countStars($post->id)?></span>)
						</span>
						
					<?php endif;?>
						
				</span>
				<span class="p-int comment">
					<span class="p-interaction p-comment" data-comment-post = "/posts/alterComment/<?= $post->id?>">

						<i class="fa fa-comments"></i> Comment
						(<span class="ch-count"><?= $postsCell->countComments($post->id)?></span>)
					</span>
				</span>
				<span class="p-int share">
					<span class="p-interaction p-share" data-share-post = "/posts/sharePost/<?= $post->id?>">
						<i class="fa fa-share-alt"></i> <a href="/posts/share-post/<?= $post->id?>">Share</a>
					</span>
				</span>
				<div class="comment-post">
					<input type="text" name="commentPost" class="form-control comment-post" placeholder="Leave a comment" data-post="<?=$post->id?>">
					<span class="post-erroneous"></span>
				</div>
			</div>
			</div>
			
		</div>
		<?php if($postsCell->countComments($post->id) >= 1) :?>
		<div class="post-comments-list">
			<?php $postsCell->renderComments($post->id);?>
		</div>
		<?php endif;?>
	</div>
	
	<?php endforeach;?>

</div>
<div class="bottom" data-nbr-pages="<?= $this->Paginator->counter(['format' => '{{pages}}'])?>">
	<?=$this->Html->image('loader.svg')?>
</div>