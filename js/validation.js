$( document ).ready(function() {

	var ValidName = false;
  	var ValidEmail = false;
 	var ValidPassword = false;
 	var ValidConfirmPassword = false;

 		//Validate Name
		$( "#first-name" ).blur(function() {
		$("#name-message").empty();

		//Must be required
		if( $(this).val().length === 0 ){
			$("#name-message").removeClass("success").addClass("error").append("<p>This is required</p>");
			ValidName = false;
			return;
		}

		//Cannot be greater than 20 Characters
		if( $(this).val().length > 20 ){
			$("#name-message").removeClass("success").addClass("error").append("<p>Cannot be Greater than 20 Characters</p>");
			ValidName = false;
			return;
		}

		//Success
		$("#name-message").removeClass("error").addClass("success").append("<p>Good to Go</p>");
		ValidName = true;
	});



		

 		//Validate Last Name
		$( "#last-name" ).blur(function() {
		$("#last-name-message").empty();

		//Must be required
		if( $(this).val().length === 0 ){
			$("#last-name-message").removeClass("success").addClass("error").append("<p>This is required</p>");
			ValidName = false;
			return;
		}

		//Cannot be greater than 20 Characters
		if( $(this).val().length > 20 ){
			$("#last-name-message").removeClass("success").addClass("error").append("<p>Cannot be Greater than 20 Characters</p>");
			ValidName = false;
			return;
		}

		//Success
		$("#last-name-message").removeClass("error").addClass("success").append("<p>Good to Go</p>");
		ValidName = true;
	});


	
		//Validate Email
		$( "#email" ).blur(function() {
		$("#email-name-message").empty();

		//Must be required
		if( $(this).val().length === 0 ){
			$("#email-name-message").removeClass("success").addClass("error").append("<p>This is required</p>");
			ValidEmail = false;
			return;
		}

		//Checks with Regular Express to see if it is a valid Email
		var reg = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
		if( !$(this).val().match(reg)){
			$("#email-name-message").removeClass("success").addClass("error").append("<p>This email address is invalid</p>");
			ValidEmail = false;
			return;
		}

		//Does not validate if email is already in the database

		//Success
		$("#email-name-message").removeClass("error").addClass("success").append("<p>Good to Go</p>");
		ValidEmail = true;
	});
 	



 		//Validate Password
		$( "#password-first" ).blur(function() {
		$("#password-name-message").empty();

		//Must be Required
		if( $(this).val().length === 0 ){
			$("#password-name-message").removeClass("success").addClass("error").append("<p>This is required</p>");
			ValidPassword = false;
			return;
		}

		//Must be at least 8 Characters
		if( $(this).val().length < 8 ){
			$("#password-name-message").removeClass("success").addClass("error").append("<p>Must be at least 8 Characters</p>");
			ValidPassword = false;
			return;
		}

		// //Must have a Digit
		// var digit_pattern = new RegExp("[0-9]", "g");
		// if( !$(this).val().match(digit_pattern)){
		// 	$("#password-name-message").removeClass("success").addClass("error").append("<p>Must have a Digit</p>");
		// 	ValidPassword = false;
		// 	return;
		// }

		// //Must have a Uppercase Letter
		// var upper_pattern = new RegExp("[A-Z]", "g");
		// if( !$(this).val().match(upper_pattern)){
		// 	$("#password-name-message").removeClass("success").addClass("error").append("<p>Must have a Uppercase Letter</p>");
		// 	ValidPassword = false;
		// 	return;
		// }

		//Success
		$("#password-name-message").removeClass("error").addClass("success").append("<p>Good to Go</p>");
		ValidPassword = true;
	});


	
	//Validate Confirm Password
		$( "#password-confirm" ).blur(function() {
		$("#password-confirm-message").empty();

		//Must be required
		if( $(this).val().length === 0 ){
			$("#password-confirm-message").removeClass("success").addClass("error");
			$("#password-confirm-message").append("<p>This is required</p>");
			ValidConfirmPassword = false;
			return;
		}

		//Must match previous password
		var Match = $("#exampleInputPassword1").val();
		if( !$(this).val().match(Match)){
			$("#password-confirm-message").removeClass("success").addClass("error").append("<p>Password does not match</p>");
			ValidConfirmPassword = false;
			return;
		}

		//Success
		$("#password-confirm-message").removeClass("error").addClass("success").append("<p>Good to Go</p>");
		ValidConfirmPassword = true;
	});

	


 	//Validate Confirm Password
 	$( "#password-confirm" ).blur(function() {
 		$("#password-confirm-message").empty();
 
 		//Must be required
 		if( $(this).val().length === 0 ){
 			$("#password-confirm-message").removeClass("success").addClass("error");
 			$("#password-confirm-message").append("<p>This is required</p>");
 			ValidConfirmPassword = false;
 			return;
 		}
 
 		//Must match previous password
 		var Match = $("#password-confirm").val();
 		if( !$(this).val().match(Match)){
 			$("#password-confirm-message").removeClass("success").addClass("error").append("<p>Password does not match</p>");
 			ValidConfirmPassword = false;
 			return;
 		}
 
 		//Success
 		$("#password-confirm-message").removeClass("error").addClass("success").append("<p>Good to Go</p>");
 		ValidConfirmPassword = true;
 	});

 	///When submit button is clicked
	 $('#signup-submit').click(function(event){
		event.preventDefault();
		if(ValidName === true && ValidEmail === true && ValidPassword === true && ValidConfirmPassword === true){
			$( "#sign-up-padding" ).submit();	
		} else{
			$("#form-message").empty().addClass("error").append("<p>You have some errors</p>")

	        $("#sign-up-padding input").each(function() {
	        	if( $(this).val().length === 0 ){
	        		$(this).parent().children("span").empty();
	        		$(this).parent().children("span").removeClass("success").addClass("error").append("<p>This is required</p>");
	        	}
	        });
		}
	});


















 














































});
