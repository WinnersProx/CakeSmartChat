
// To display all of messages using ajax

$.ajax({
		type   : 'GET',
		url    : 'show_messages.php',
		
		success: function(msg){
			$('#prmessage').html(msg);
		}

	});






