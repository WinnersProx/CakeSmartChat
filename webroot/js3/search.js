$(document).ready(function(){
	//rechercher users
    var url = 'ajax/search.php';

    $('#searchbox').on('keyup',function(){
        var query = $(this).val();
        if(query.length > 0){

             $.ajax({

            type : "POST",
            url   : url,
            data  : {
                    query : query
            },
            beforeSend: function(){
                $("#spinner").show();

            },
            success :function(data){
                
               $('#diplay-results').html(data).show();  
               
            }
        });

        } else{
            $("#spinner").hide();
            $('#diplay-results').hide();
        }
    });


});