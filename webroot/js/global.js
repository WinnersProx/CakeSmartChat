$(document).ready(function(){

recupMessage();

	$('.timeago').timeago();
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
	//sweetalert
    $('[data-confirm]').on('click', function(e){
		  e.preventDefault(); //Annuler l'action par défaut

		 //Récupérer la valeur de l'attribut href
		 var href = $(this).attr('href');

		 //Récupérer la valeur de l'attribut data-confirm
		 var message = $(this).data('confirm');

		 //On aurait pu écrire aussi
		 //var message = $(this).attr('data-confirm');

		 //Afficher la popup SweetAlert

		 swal({
		 title: "Êtes-vous sûr?",
		 text: message, //Utiliser la valeur de data-confirm comme text
		 type: "warning",
		 showCancelButton: true,
		 cancelButtonText: "Annuler",
		 confirmButtonText: "Oui",
		 confirmButtonColor: "#DD6B55"},

		  function(isConfirm){
		 if(isConfirm) {
		 //Si l'utilisateur clique sur Oui,
		 //Il faudra le rediriger l'utilisateur vers la page
		 //de suppression
		 window.location.href = href;
		 }
	 });

     });

    //for micropost
    $(".like").on("click",function(event){
    	event.preventDefault();

    	var id = $(this).attr("id");

    	var url ='ajax/micropost_like.php';

    	var action = $(this).data('action');

    	var micropostId = id.split("like")[1];


    	$.ajax({

    		type : "POST",
    		url   : url,
    		data  : {
    				micropost_id : micropostId,
    				action : action
    		},
    		success :function(likers){
    			$("#likers_" + micropostId).html(likers);
    			
    			if(action == 'like'){
    				$("#" + id).html("<i class='fa fa-thumbs-o-down fa-lg' ></i> Je n'aime plus").data('action','unlike');
    			}else
    			{
    				$("#" + id).html("<i class='fa fa-thumbs-o-up fa-lg' ></i> J'aime").data('action','like');
    			}
    		}

    	});

    });


    //for post mot du jour


     $(".llike").on("click",function(event){
        event.preventDefault();

        var id = $(this).attr("id");

        var url ='ajax/post_like.php';

        var action = $(this).data('action');

        var postId = id.split("llike")[1];


        $.ajax({

            type : "POST",
            url   : url,
            data  : {
                    post_id : postId,
                    action : action
            },
            success :function(llikers){
                $("#llikers_" + postId).html(llikers);
                
                if(action == 'llike'){
                    $("#" + id).html("<i class='fa fa-thumbs-o-down fa-lg' ></i> Je n'aime plus").data('action','unllike');
                }else
                {
                    $("#" + id).html(" <i class='fa fa-thumbs-o-up fa-lg' ></i> J'aime").data('action','llike');
                }
            }

        });

    });


    //for post boom scolaire


     $(".llikke").on("click",function(event){
        event.preventDefault();

        var id = $(this).attr("id");

        var url ='ajax/post_like_boom.php';

        var action = $(this).data('action');

        var postId = id.split("llikke")[1];


        $.ajax({

            type : "POST",
            url   : url,
            data  : {
                    post_id : postId,
                    action : action
            },
            success :function(llikkers){
                $("#llikkers_" + postId).html(llikkers);
                
                if(action == 'llikke'){
                    $("#" + id).html("<i class='fa fa-thumbs-o-down fa-lg' ></i> Je n'aime plus!!!").data('action','unllikke');
                }else
                {
                    $("#" + id).html("<i class='fa fa-thumbs-o-up fa-lg' ></i> J'aime!!!").data('action','llikke');
                }
            }

        });

    });



     //for post NEWS


     $(".lliikke").on("click",function(event){
        event.preventDefault();

        var id = $(this).attr("id");

        var url ='ajax/post_like_news.php';

        var action = $(this).data('action');

        var postId = id.split("lliikke")[1];


        $.ajax({

            type : "POST",
            url   : url,
            data  : {
                    post_id : postId,
                    action : action
            },
            success :function(lliikkers){
                $("#lliikkers_" + postId).html(lliikkers);
                
                if(action == 'lliikke'){
                    $("#" + id).html("<i class='fa fa-thumbs-o-down fa-lg' ></i> Je n'aime plus!!!").data('action','unlliikke');
                }else
                {
                    $("#" + id).html("<i class='fa fa-thumbs-o-up fa-lg' ></i> J'aime!!!").data('action','lliikke');
                }
            }

        });

    });

     //for post Pub


     $(".lliikkee").on("click",function(event){
        event.preventDefault();

        var id = $(this).attr("id");

        var url ='ajax/post_like_pub.php';

        var action = $(this).data('action');

        var postId = id.split("lliikkee")[1];


        $.ajax({

            type : "POST",
            url   : url,
            data  : {
                    post_id : postId,
                    action : action
            },
            success :function(lliikkeers){
                $("#lliikkeers_" + postId).html(lliikkeers);
                
                if(action == 'lliikkee'){
                    $("#" + id).html("<i class='fa fa-thumbs-o-down fa-lg' ></i> Je n'aime plus!!!").data('action','unlliikkee');
                }else
                {
                    $("#" + id).html("<i class='fa fa-thumbs-o-up fa-lg' ></i> J'aime!!!").data('action','lliikkee');
                }
            }

        });

    });

     //for post Sport


     $(".lliikkke").on("click",function(event){
        event.preventDefault();

        var id = $(this).attr("id");

        var url ='ajax/post_like_sport.php';

        var action = $(this).data('action');

        var postId = id.split("lliikkke")[1];


        $.ajax({

            type : "POST",
            url   : url,
            data  : {
                    post_id : postId,
                    action : action
            },
            success :function(lliikkkers){
                $("#lliikkkers_" + postId).html(lliikkkers);
                
                if(action == 'lliikkke'){
                    $("#" + id).html("<i class='fa fa-thumbs-o-down fa-lg' ></i> Je n'aime plus!!!").data('action','unlliikkke');
                }else
                {
                    $("#" + id).html("<i class='fa fa-thumbs-o-up fa-lg' ></i> J'aime!!!").data('action','lliikkke');
                }
            }

        });

    });

           function update_user_activity()
           {
            var action = 'update_time';
            $.ajax({
               url:"ajax/action.php?",
               method:"POST",
               data:{action:action},
               success:function(data)
               {

               }
            });
           }
           setInterval(function(){
               update_user_activity()
           },3000);

          fetch_user_login_data();
          setInterval(function(){
              fetch_user_login_data();
          },3000);
          function fetch_user_login_data()
          {
              var action = "fetch_data";
              $.ajax({
                url:"ajax/action.php?",
                method:"POST",
                data:{action:action},
                success:function(data)
                {
                  $('#user_login_status').html(data);
                }

              });
          }

          $('#send').click(function(){
            var message = $('#message').val();

            if(message != '') {
              $.post('ajax/post.php',{message:message},function(){
                  recupMessage();
                  $('#message').val('');
              });
            }

          });
          function recupMessage(){
            $.post('ajax/recup.php',function(data){
               $('.message-box').html(data);
              });
           }
           setInterval(recupMessage,1000);

});