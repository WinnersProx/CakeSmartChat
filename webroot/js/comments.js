$(document).ready(function(){
	$('.textar').hide();
	$('a.comment').click(function(){
		$(this).parent().parent().next().slideToggle();
	});

})