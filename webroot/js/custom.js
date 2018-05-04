(function(){
	$('#StartLiveImage').click(function(){
		$Url = window.URL || window.webkitURL, /*$canvas = $('#canvas')*/$image = $('#myWebmedia');
		//$context = canvas.getContext('2d');
		navigator.getMedia = navigator.getUserMedia       || 
							 navigator.webkitGetUserMedia ||
							 navigator.mozGetUserMedia    ||
							 navigator.msGetUserMedia;

		navigator.getMedia({
			video : true,
			audio : false
		}, function(stream) {
			$('#myWebmedia').attr('src', $Url.createObjectURL(stream));
			//$('#myWebmedia').play();
		}, function(error) {
			$('#myWebmedia').replaceWith('<span>Please you do not have a camera please buy one or use your phone!</span>');
			console.log("An error has occured");
		})

		$('.addPicture').click(function(){
			$context.drawImage($image, 0,0,200,300);
		})

		/*$('.closeImage').click(function(){
			navigator.getMedia = null;
			$('#myWebmedia').removeAttr('src');
		})
		*/



	});

})();