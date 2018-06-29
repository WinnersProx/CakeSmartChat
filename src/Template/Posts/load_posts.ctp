<?php 
			$postsCell = $this->cell('Posts');

	?>
	<?php foreach($myposts as $post):?>
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