$(document).ready(function(){
	$('.login-form').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            },
            remember: {
                required: false
            }
        },

        messages: {
            username: {
                required: "Username is required."
            },
            password: {
                required: "Password is required."
            }
        },

        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-danger', $('.login-form')).show();
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            error.insertAfter(element.closest('.input-icon'));
        },

      
    });
	$("#username").focus();
	$("#username").keyup( function(event){
		if( event.keyCode == 13 ){
			$("#password").focus();
		}
	});	
	$("#password").keyup( function(event){
		if( event.keyCode == 13 ){
			onLoginCheck();
		}
	});
	
});


function onLoginCheck(){
	var username  =$("#username").val();
	var password =$("#password").val();
	if ($('form.login-form').valid()) {
		$.ajax({
			 url: "./async-login.php",
				cache : false,
				dataType : "json",
				type : "POST",
				data : { username : username ,password:password },
				success : function(data){
					if(data.result == "success"){
						window.location.href = "overview.php";
					}
					else{
						  $('.alert-danger', $('.login-form')).show();
					}
				}
		});
	}
}