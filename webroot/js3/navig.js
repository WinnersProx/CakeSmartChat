/*$(function(){
	$('.ajax').click(function(){
		$('.loader').fadeIn();
		$.get($(this).attr('href'),{},function(data){
			$('.comment').empty().append(data);
			$('.loader').fadeOut();
		});
		return false;
	});

	$('.ajaxsend').click(function(){
		$('#sending').fadeIn();
		$.get($('.msg').val(),{}, function(response){
			alert($('.msg').val());
			//$('#success').empty().append(response);
		});
		return false;
	});

});
/*
'before' =>  $this->js->get('#sending')->effect('fadeIn'),
	'success' => $this->js->get('#success')->effect('fadeOut'),
	'update'  => '#success'

*/