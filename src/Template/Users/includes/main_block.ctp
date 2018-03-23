<span class="logged">
    <?= $this->Html->Image('../'.$connected['avatar'],['class' => 'user-avatar-xs img-user'])?>
</span>
<span class="announce">Welcome Here is a friendship app maker expand your acquaintances inviting your facebook friends!</span>
<div class="post">
	<div class="row">
		<form method="post" enctype="multipart/form-data">
			<div class="col-md-12">
				<textarea name="about" placeholder="What's up!" class="content" rows="2" required="required" id="about"></textarea>
				<div class="poster">
				<i class="fa fa-image fa-lg postfile"></i> <i class="fa fa-link fa-lg postfile"></i><input type="file" name="picture"  id="file">

				</div>
			</div>
		</form>
	</div>
	<div class="post-lists">
		
	</div>
	
	
</div>