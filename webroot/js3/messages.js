$('#poster_id').hide();
$('#poster').on('click', function(){
	$('#poster_id').show();
});
$('#content').on('blur', function(){
	$('#poster_id').hide();
});

//for messages

$('#show_messages').hide();

$('#contentm').on('blur', function(){
	$('u_posts').show();
});


