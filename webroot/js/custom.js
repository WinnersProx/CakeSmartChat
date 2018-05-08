(function(){
	$('#StartLiveImage').click(function(){
		$Url = window.URL || window.webkitURL, 
		$canvas = document.getElementById('canvas'), 
		$context = canvas.getContext('2d'), 
		$preview = $('#preview'),
		$file = $('#liveUpload'),
		$image = document.getElementById('myWebmedia'),

		navigator.getMedia = navigator.getUserMedia       || 
							 navigator.webkitGetUserMedia ||
							 navigator.mozGetUserMedia    ||
							 navigator.msGetUserMedia;

		navigator.getMedia({
			video : true,
			audio : false
		}, function(stream) {
			$image.setAttribute('src', $Url.createObjectURL(stream));
			
		}, function(error) {
			$image.replaceWith('<span>Please you do not have a camera please buy one or use your phone!</span>');
			console.log("An error has occured");
		})

		$('#captureImg').click(function(){
			
			$context.drawImage($image, 0,0,400,400);
			$preview.attr('src', $canvas.toDataURL('image/png'))
			//$file.trigger('change');
			//$file.val($preview.attr('src'));
			//console.log($file.files[0]);

		})
		
		

		/*$('.closeImage').click(function(){
			navigator.getMedia = null;
			$('#myWebmedia').removeAttr('src');
		})
		//$context.fillStyle = 'gold';
			//$context.fillRect(0, 0, 50, 80);
		*/



	});

})();