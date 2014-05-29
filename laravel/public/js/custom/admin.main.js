$(document).ready(function() {
    $('.actions span').tooltip();
    $('.alert').alert();
    
    $('.deletepost').click(function(){
        var id = $(this).attr('id');
        var idpost = id.split("_")[1];
        $('#confdeletepost').click(function(){
            var newhref = baseUrl+'/page/deletepost/'+idpost;
            $('#confdeletepost').attr('href',newhref);          
        });
    });
    $('#canceldelpost').click(function(){
       $('#myModal').modal('hide');
    });
    
    
    $('.deletemenu').click(function(){
        var id = $(this).attr('id');
        var idpost = id.split("_")[1];
            var newhref = 'http://localhost/arobsacademy/public/menus/delete/'+idpost;
            $('#confdeletemenu').attr('href',newhref);           
    });
    $('#canceldelmenu').click(function(){
       $('#myModal').modal('hide');
    });
 $('.deleteuser').click(function(){
        var id = $(this).attr('id');
        var iduser = id.split("_")[1];
        $('#confdeleteuser').click(function(){
            var newhref = baseUrl+'/users/delete/'+iduser;
            $('#confdeleteuser').attr('href',newhref);       
        });           
    });
    $('#canceldeluser').click(function(){
       $('#myModal').modal('hide');
    });
    $('.deletewidget').click(function(){
        var id = $(this).attr('id');
        var idwidget = id.split("_")[1];
        $('#confdeletewidget').click(function(){
            var newhref = baseUrl+'/widgets/delete/'+idwidget;
            $('#confdeletewidget').attr('href',newhref);       
        });           
    });
    $('#canceldelwidget').click(function(){
       $('#myModal').modal('hide');
    });
    
    //widgets page
    $('#custom_multiselect').multipleSelect();
    
 $('#create-user-details').validate({
    	rules: {
    		username: "required", 
    		password: {
    			required: true,
    			minlength: 8
    		},
 			email: {
 				required: true,
 				email: true
 			}
		},
		messages: {
			username: "The username field is required.",
			password: {
				required: "The password field is required.",
				minlength: "The password must be at least 8 characters."
			},
			email: {
				required: "The email field is required.",
				email: "The email is not valid"
			}
		}
    });
$('#validate-register').validate({
        rules:{
            username: "required",
            password: {
    			required: true,
    			minlength: 8
    		},
            email: {
 			required: true,
 			email: true
 			}
		},
            title: {required:true,minlength:3},
            title_alias: {required:true,minlength:3,maxlength:10},
            intro_text: {required:true},
            full_text: {required:true}
            
        },messages:{
            title:{required:"The title is required",
                   minlength:"The title must contain 3 characters"},
            title_alias:{required:"The title-alias is required",
                         minlength:"The title-alias must contain at least 3 character",
                         maxlength:"The title-alias must contain at most 10 characters"   },
            intro_text:{required:"The intro-text is required",},
            full_text:{required:"The full-text is also required"}
    }
      
});
$('#validate-menus').validate({
        rules:{
            title: {required:true,minlength:3},
            url: {required:true}
        },messages:{
            title:{required:"The title is required",
                   minlength:"The title must contain 3 characters"},
            url:{required:"The url is required valid"}
        }
});
$('#validate-login').validate({
        rules: {
    		username: "required", 
    		password: {
    			required: true,
    			minlength: 3
    		},messages: {
			username: "The username field is required.",
			password: {
				required: "The password field is required.",
				minlength: "The password must be at least 8 characters."
			}
                    }
                }
});

$('#form-simple-forward').hide();
$('#form-simple-reply').hide();
$('#form-simple-edit').hide();


$("#click-toolge-forward").click(function() {
        $('#form-simple-reply').hide();
        $('#form-simple-edit').hide();
	$('#form-simple-forward').slideToggle(500);
});
$("#click-toolge-reply").click(function() {    
        $('#form-simple-edit').hide();
	$('#form-simple-forward').hide();
	$('#form-simple-reply').slideToggle(500);
});
$("#click-toolge-edit").click(function() {
        $('#form-simple-reply').hide(1000);
	$('#form-simple-forward').hide(1000);
       
	$('#form-simple-edit').slideToggle(1000);
});

});

