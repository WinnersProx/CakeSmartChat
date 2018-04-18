<div class="user-event">
	<div class="flash-render">
		Welcome Here is a friendship app maker expand your acquaintances inviting your facebook friends!
		<span class="flash"><?= $this->Flash->render()?></span>
	</div>
</div>
<div class="post">
	<div id="post-baker">
		<span class="post-title badge"><i class="fa fa-edit"></i> Edit a new post!</span>
		<form method="post" enctype="multipart/form-data" action="/posts/newPost">
			<textarea name="newpost" placeholder="What's up <?= $connected['name']?>!" class="content" rows="2" required="required" id="about"></textarea>
			<!--to append the modal -->
			<span class="btn btn-success post-validator" data-toggle="modal" data-target="#poster-modal"><i class="fa fa-check-circle fa-lg"></i></span>
			<!--End to appending the modal-->
			<div class="modal fade" tabindex="-1"  id="poster-modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
							<span class="modal-title">New Post From <?= $connected['name']?></span>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-7">
									<span class="badge post-opts"><i class="fa fa-font"></i> Post Content </span>
									<div class="post-text">

									</div><br/>
									<div class="post-images">

										<span class="badge post-opts"><i class="fa fa-picture-o"></i> Post Images</span> 
										<div class="img-transfer">
											<input type="file" name="imgFile[]" class="img-upload" multiple="multiple">
											<span class="post-img-baker">
												<i class="fa fa-upload"></i> Upload
											</span>
											
											<span class="uploader-text">Choose a picture</span>
											
										</div>
										<div class="img-preview uploader-text">
											None!
										</div>
										
									</div>
								</div>
								<div class="col-md-4">
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
							<button type="submit" class="btn btn-success submit-b" name="new">Poster</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>	
</div>
<div id="post-infos">
	<?php 
			$posts = $this->cell('Posts'); $postLists = $posts->postLists();

	?>
	<?php foreach($postLists as $post):?>
	<div class="post-lists">
		
		
		<div class="t-post-lists">
			<?php $Uinfos = $posts->userInfo($post->post_owner);?>
			<img src="/img/<?= $Uinfos['avatar'] ? $Uinfos['avatar'] : '/userdefault.png';?>" 
			class="user-avatar-xs">
			<span class="poster-text">
				<a href="/profiles/u/<?= $Uinfos['slug'] ?>"><?= $Uinfos['name']?></a>
				<span class="dated">posted in last <?= $posts->getDate($post->date_from);?> 
				</span>

			</span>
			<span class="tags">
				with <?php $posts->postTags($post->id);?>
			</span>
			<div class="post-content-text">
				<?= $post->content ?>
			</div>
			 

			<div class="post-images">
				<?php $posts->postImages($post->id);?>
			</div>
			<div class="posts-interaction-bar">
				<span class="p-int star">
					<?php if($posts->checkUserStar($post->id)):?>
						<span class="p-interaction p-star"  data-mix-star="unstar-<?=$post->id?>">
								<i class="fa fa-star"></i> 
								<span class="ch-text">Unstar</span>
								(<span class="ch-count"><?= $posts->countStars($post->id)?></span>)

						</span>	
					<?php else:?>
						<span class="p-interaction p-star" data-mix-star="star-<?=$post->id?>">
							<i class="fa fa-star-o fa-rotate-180"></i> <span class="ch-text">Star</span>
							(<span class="ch-count"><?= $posts->countStars($post->id)?></span>)
						</span>
						
					<?php endif;?>
						
				</span>
				<span class="p-int comment">
					<span class="p-interaction p-comment" data-comment-post = "/posts/alterComment/<?= $post->id?>">

						<i class="fa fa-comment"></i> Comment
						(<span class="ch-count"><?= $posts->countComments($post->id)?></span>)
					</span>
				</span>
				<span class="p-int share">
					<span class="p-interaction p-share" data-share-post = "/posts/sharePost/<?= $post->id?>">
						<i class="fa fa-share"></i> Share
					</span>
				</span>
				<div class="comment-post">
					<input type="text" name="commentPost" class="form-control comment-post" placeholder="Leave a comment" data-post="<?=$post->id?>">
					<span class="post-erroneous"></span>
				</div>
			</div>
		</div>
		<?php if($posts->countComments($post->id) >= 1) :?>
		<div class="post-comments-list">
			<?php $posts->renderComments($post->id);?>
		</div>
		<?php endif;?>
	</div>
	
	<?php endforeach;?>

</div>