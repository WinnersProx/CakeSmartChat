$(document).ready(function(){
	
	//user scrolling
	$(window).scroll(function(){
		$targetNav = $('.navbar-inverse');
		$NavOffsetTop = $targetNav.offset().top;
		$bodyOffsetTop = $('body').css('paddingTop')

		$navbarHeight = parseInt($targetNav.css('height')) + 65;
		if(parseInt($targetNav.css('width')) > 320){
			if($NavOffsetTop > $navbarHeight){
				$targetNav.css('opacity', 0.7);
			}
			else{
				$targetNav.css('opacity', 1);

			}
		}
		
		//for profiles now
		$imgProfile = $('#user-box-images');
		$avatarsBox = $('.user-inf-avatars');

		if($('body').attr('data-cont-name') === 'Profiles'){
			$imgProfileOffset = $imgProfile.offset().top - 65;
			$imgProfileHeight = parseInt($avatarsBox.css('height')) + $NavOffsetTop;//to test overflow of its height
			
			if($NavOffsetTop >= $imgProfileOffset && $NavOffsetTop <= $imgProfileHeight){
				$imgProfile.css('borderBottom','3px solid #b45bb4');
			}
			else{
				$imgProfile.css('borderBottom','3px solid white');
			}
		}
		
	});

	
	var menu = $('.menu-drop'),
	children = $('.menu-drop li a');
	children.on('mouseover',function(){
		$(this).animate({
			paddingLeft:25,

		}, 1000, function(){ $(this).css('paddingLeft','-=10')});
	});
	$('.ajaxInvite').click(function(e){
		var Url = $(this).attr('href');
		e.preventDefault();
		var Id = Url.split('/'),last = Url.lastIndexOf('/');
		var tUrl = Url.substr(0,last);
		console.log(tUrl);
		var renderId = Id[3], current = $(this);
		console.log(renderId);
		$.post(Url, function(result){
			if(!result.error){

				current.empty().hide();
				current.next().html(result +' <i class="fa fa-check-circle fa-lg"></i>');
			}
			else{
				current.empty().hide();
				current.next().html('not sent');
			}
		})
	});

	//For getting the number of notifications
	var notifUrl = '/users/notifications';
	$.get(notifUrl ,{},function(notif){
			if(!notif.error){
				$('.notif').append(notif);
			}
	$.ajaxSetup({cache:false});
	setInterval(function(){$('.notif').load(notifUrl)},6000);
	});
	//For getting the number of notifications




	//$('.carousel').carousel();
	/*$('#tgglclass').hide();
	$('#tgglclass').animate(function(){
		var childs = $(this).childs;
		for(var i=0;i<childs;i++){
			childs[i].show();
		}
	})*/
	var chat_reduced = true, 
		chat_reduced_height = 24, 
		chat_append_height = 185,
		chat_append_time = 600,
		chat_reduced_time = 1500;
	$('chat-contents').hide();
	$('.chat-box-header').click(function(){
		var c = $('.chat-box'),
			currentHeight = c.height();
		if(chat_reduced){
			c.animate({height : chat_append_height},chat_append_time, function(){
				
			});
			
			chat_reduced = false;
		}
		else{
			c.animate({height : chat_reduced_height},chat_reduced_time, function(){
				alert('chat box reduced');
			});
			chat_reduced = true;
		}

	});
	//For notifications all about them
	$('.toggle-notifs').click(function(e){
		e.preventDefault();
		var tUrl = $(this).attr('href');
		$.get(tUrl ,{},function(content){
			if(!content.error){
				$('#notif-view').slideToggle().html(content);
			}
		$.ajaxSetup({cache:false});
		//setInterval(function(){$('#notif-view').load(tUrl)},10000);
		});

	});
	//now for the innovations after a period
	$('.post-validator').click(function(e){
		var $content = $('.content').val();
		if($content == ' '){
			$('.post-text').html('<p class="erroneous">please write something about your post!</p>');
		}
		$('.post-text').html($content);
		
	});
	$('.privacy').click(function(e){
		e.preventDefault();
		$('.privacy-infos').fadeIn(500);
	});  
	$('.tag').click(function(e){
		e.preventDefault();
		$('.tag-infos').fadeIn(500);
	});
	$('.post-title').click(function(){
		$('#about').focus();
	});
	//for uploading the image post style now
	$('.img-upload').change(function(e){
		var $files = $(this)[0].files, imgCount = $files.length,
		imgPath = $(this)[0].value, imgExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1).toLowerCase(),
		$previewImg = $('.img-preview');
		var $allowedExtensions = ['jpg','jpeg','png','bmp'];$previewImg.empty();
		if($allowedExtensions.indexOf(imgExtension) != -1){
			if(typeof(FileReader) != 'undefined'){
				for (var i = 0; i < imgCount; i++) {
					var $fReader = new FileReader(),fName = $files[i].name, 
					fSize = $files[i].size, fType =$files[i].type;
					$fReader.onload = function(e){
						$("<img />", {
							"src" : e.target.result,
							"width" : "146",
							"height" : "200",
							"title" : fName + 'Has '+ fSize + 'bytes, type: ' + fType,
							"class" : "img-thumbnail"
						}).appendTo($previewImg);

					}
					$fReader.readAsDataURL($(this)[0].files[i]);
				}
				 
			}
		}
		else{
			$previewImg.append("This extension is not allowed");
		}
		
		



	});
	//uploading the image post end now

	//for uploading the user avatar quickly
	$('.avatar-update').click(function(e){
		$('.avatarSetter').trigger('click');
	})
	$('.avatarSetter').change(function(e){
		var $files = $(this)[0].files, imgCount = $files.length,
		imgPath = $(this)[0].value, imgExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1).toLowerCase(),
		$previewImg = $('.avatar-update');
		var $allowedExtensions = ['jpg','jpeg','png','bmp'];$previewImg.empty();
		console.log(imgExtension);
		if($allowedExtensions.indexOf(imgExtension) != -1){
			if(typeof(FileReader) != 'undefined'){
				for (var i = 0; i < imgCount; i++) {
					var $fReader = new FileReader(),fName = $files[i].name, 
					fSize = $files[i].size, fType =$files[i].type;
					$fReader.onload = function(e){
						$("<img />", {
							"src" : e.target.result,
							"title" : fName + 'Has '+ fSize + 'bytes, type: ' + fType,
							"height" : 166,
							"width"  : 170,
							"class"  : "data-avatar-img-update"
						}).appendTo($previewImg);

						$('.upload-validate').slideDown(1000);

					}
					$fReader.readAsDataURL($(this)[0].files[i]);
					var $userAvatar = $(this)[0].files[i];
					//comp codes
					$('#subAvatar').submit(function(e){
					e.preventDefault();
					var $this = $(this), url = '/users/avatar-upload'; 
					//good just constrained
					//console.log(new FormData());
					$.ajax({
						url:url,
						type:"POST",
						data:new FormData(this),
						contentType:false,
						processData:false,
						success:function(data){
							$('.upload-validate').html('uploaded successfuly');
							$('.upload-validate').slideUp(2500);
						}
					});
					/*$.post(url, {$userAvatar: form}, function(response){
						if(!response.error){
							alert('Sent successfuly');
						}
						else{
							alert(response.error);
						}
					});*/

					});
					
					//comp codes
					$('.upload-validate').click(function(e){

						$('#subAvatar').trigger('submit');

					});

				}
				 
			}
		}
		else{
			$('.upload-validate').hide();
			$newError = '<div class="newCl">This extension is not allowed change it</div>'
			$previewImg.html($newError);
		}
		
		



	});
	//for uploading the user avatar quickly<<End!!!<<>><<end>>
	//for displaying remaining tags
	$('.sub').mouseover(function(e){
		var $target = $(this).next(), $parent = $(this).parent();
		$target.fadeIn(1000).css('display', 'inline-block');
		$parent.mouseleave(function(e){
			$target.fadeOut(1000);
		});
	});
	//for commenting the post
	$('.p-comment').click(function(e){
		var $this = $(this);
		$this.parent().next().next().slideToggle().children().focus();
	})
	//for commenting the post

	//
	$('.p-star').click(function(e){
		e.preventDefault();
		var $this = $(this), $dataStar = $this.attr('data-mix-star').split('-'),
		$starVal = $dataStar[0], $postId = $dataStar[1];
		$child = $this.children('i'), $cText = $this.children('span.ch-text'),
		$countstars = $this.children('span.ch-count'), $count = parseInt($countstars.text());

		if($starVal == 'star'){
			var $tUrl = '/posts/likePost/'+ $postId;
			$child.removeClass('fa fa-star-o fa-rotate-180').addClass('fa fa-star');
			$cText.html('Unstar');
			$count = $count + 1;
			$countstars.text($count);
			$.post($tUrl,{}, function(added){
				if(!(added.error)){
					$this.attr('data-mix-star', 'unstar-' + $postId);
				}
			});

			
		}
		if($starVal == 'unstar'){
			var $tUrl = '/posts/dislikePost/'+ $postId;
			$child.removeClass('fa fa-star').addClass('fa fa-star-o fa-rotate-180');
			$cText.html('Star');
			$count = $count - 1;
			$countstars.text($count);
			$.post($tUrl,{}, function(removed){
				if(!(removed.error)){
					$this.attr('data-mix-star', 'star-' + $postId);
				}
			});
			
		}
		
	});
	//
	$('.comment-post').keypress(function(e){
		var pressed = e.which || e.keyCode, $this = $(this),
		content = $this.val(),$postId = $this.attr('data-post');
		if(pressed == 13){
			if(content.length >= 2){
				url = '/posts/commentPost/' + $postId;
				$this.blur();
				$.post(url, {content:content},function(sent){
					if(!(sent.error)){
						$this.val('');
						$this.attr('placeholder', 'click on link comment to hide the form if no more comments!');
						$this.parent().children('span.post-erroneous').empty();
					}
				});
			}
			else{
				console.log($this.parent().children('span.post-erroneous').html('Too short comment!'));
			}
		}
	})
	//for sending messages // friends discussions
	$('#MsgBoxSender').submit(function(e){
		e.preventDefault();
		$this = $(this);

		$listMsgs = $('.msgs-lists');
		console.log($listMsgs); 
		$lists = $listMsgs.children('.slidingMessages');
		$endMsg = $('#endMsg').offset().top;
		
		$iputAreaMessage = $this.children('div.MsgInputBox');
		$children = $iputAreaMessage.children('.msgSender');
		$contentMessage = $children.val();
		$msgLength = $contentMessage.length;
		$dataTarget = $('.target-user').attr('data-user-target');
		
		if($msgLength >= 2 && $msgLength <= 255){
			$senderUrl = '/messages/sendMessage/'+ $dataTarget;
			if($dataTarget != 'undifined'){
				$('span.msg-box-error').fadeOut(1000);
				$.ajax({
						url:$senderUrl,
						type:"POST",
						data:new FormData(this),
						contentType:false,
						processData:false,
						success:function(data){
							$children.val('');
							$children.attr('placeholder', 'message sent successfully!');
							$children.blur();
							$t_page = window.location.href;

							$t_u_id = $t_page.substr($t_page.lastIndexOf('/') + 1);
							$('.inst-conversations').load('/messages/list_messages/'+ $t_u_id);
							// $tW = window.location.href;
							// $l_Ind = $tW.substr(0, $tW.lastIndexOf('/') + 1);
							// $trUrl = $l_Ind + $('.inst-conversations').attr('data-user-m');
							//load($trUrl);

						}
				});

			}
			else{
				$('span.msg-box-error').fadeIn(2000).html('please select a friend');
			}
			
			$listMsgs.animate({
			scrollTop : $endMsg
			}, 2000);


			
		}
		else{
			$listMsgs.animate({
			scrollTop : $endMsg
			}, 1000);
			$('span.msg-box-error').fadeIn(2000).html('the message must be at least 2 characters long');
		}
		
		
	});
	$('.profile-opts').click(function(e){
		$this = $(this);
		$exclude = $(this).attr('data-exclude');
		if(!$exclude){
			e.preventDefault();
			$focusForward = $this.children().attr('data-focus');
			
			$targetBlock = $('#user-box-'+ $focusForward);
			
			$allMenus = $('.profile-opts');
			$allMenus.children().css('borderBottom','2px solid white');
			$this.children().css('borderBottom','3px solid #b45bb4');
			$ABox = $('.user-informations');

			$offsetH = $targetBlock.offset().top - 65;
			$('html, body').animate({
				scrollTop : $offsetH
			}, 2000);
			
			
		}
		
	});
	/*Start ==> editing my profile script*/
	$backColor = $('body').css('backgroundColor');
	$('#next').click(function(e){
		$firstDisplayed = true;
		$('body').css('backgroundImage', 'linear-gradient(to bottom, #251725,#b5b5b5)');
		
		$('#profile-edition').css('color','white');
		$('label').css('color','#fff4f4');
		$changes = $('.Notify-changes');
		$changes.fadeIn(2000);
		$changes.after('<div class="fa fa-spinner fa-pulse fa-lg w-spine"></div>');

		setInterval(function(){ $('.w-spine').hide()},3000);
		if($firstDisplayed){
			$('.first-edit-block').hide();
			$('.last-edit-block').fadeIn(1000);
		}
	});
	$('#prev').click(function(e){
		$('body').css('backgroundImage', '');
		$('body').css('backgroundColor', $backColor);
		$('.Notify-changes').fadeOut(2000);
		$('.last-edit-block').hide();
		$('.first-edit-block').fadeIn(1000);
	});

	/*End ==> editing my profile script*/

	$contName = $('body').attr('data-cont-name');
	if($contName == 'Messages'){

		$('.Messsages-opts').ready(function(){
		$listMsgs = $('.msgs-lists');
		$endMsg = $('#endMsg').offset().top;
		$listMsgs.animate({
					scrollTop : $endMsg
			}, 500);
		});
	}
	//Live users instant chat with chatbox chatbox chatbox chatbox
	$('.user-online').click(function(){
		$receiverId = $(this).attr('data-liveuid');
		console.log($receiverId)
		$tBox = $('.appendable-boxes');
		$tBox.append($('.chat-box'));
		$('.chat-box').show();
		$('.chat-box .chat-box-header').attr('id', $receiverId);
		
	})
	//Live users instant chat with chatbox chatbox chatbox chatbox
	$('.community-block').mouseenter(function(e){
		$this = $(this);
		$targetChildren = $this.children('.community-description');
		console.log($targetChildren);
		$targetChildren.slideDown(1000);
		

	});
	$('.community-block').mouseleave(function(){
		$this = $(this);
		$targetChildren = $this.children('.community-description');
		$targetChildren.slideUp(500);
	});
	

		/*
		$targetMenu.animate({


		}, function(){
			alert("appended successfully");
		})
		*/
	

	$invisible = true;
	
	$('.t-uxs-menus').click(function(){

		$targetMenu = $('#UxsSideMenu'), 
		$targetMenuWidth = $targetMenu.css('width'); 
		stockWIdth = parseInt($targetMenuWidth);
		if($invisible){
			
			
			$(this).removeClass('fa-arrow-circle-left').addClass('fa-arrow-circle-right');
			$targetMenu.css('width', stockWIdth + 'px');
			$targetMenu.css('display','block');
			$w = 0;

			function increaseWidth(){
				$w += 5;
				$last = $w + 5;
				$('#main-p').css('opacity', 0.8);
				$targetMenu.css('width', $last + 'px')
				
				if($last < stockWIdth){
					setTimeout(increaseWidth, 5)
				}


			}
			increaseWidth()

			$invisible = false;

		}
		else{
			$(this).removeClass('fa-arrow-circle-right').addClass('fa-arrow-circle-left');
			$targetMenuWidth = stockWIdth, $w = stockWIdth;
			$opacity = 0.4;
			function decreaseWidth(){
				$w -= 5;
				$opacity += 0.1;
				$last = $w - 5;

				$('#main-p').css('opacity', $opacity);
				$targetMenu.css('width', stockWIdth + 'px');
				$targetMenu.css('width', $last + 'px')
				if($last > 0){
					
					setTimeout(decreaseWidth, 0.5);
				}
				else{

					$targetMenu.css('display','none');
					$targetMenu.css('width', $targetMenuWidth + 'px')
					
				}

			}
			decreaseWidth();

			$invisible = true;

		}

		
	});
	// about messages


});
//
$('.ajaxConfirm').click(function(e){
		e.preventDefault();

		var urlC = $(this).attr('href'), $current = $(this);
		var tUrl = urlC.split('/');
		var sender = tUrl[1], receiver = tUrl[2];
		$.post(urlC ,function(content){
			if(!content.error){
				$('.ajaxConfirm').html(content);
				$current.empty().hide();
				$current.next().html(content +' <i class="fa fa-plus-circle fa-lg"></i>');
			}
		$.ajaxSetup({cache:false});
		//setInterval(function(){$('#notif-view').load(tUrl)},10000);
		});

});
