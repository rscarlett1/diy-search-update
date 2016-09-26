<!DOCTYPE html>

<html lang="en-nz">

<head>
		<meta charset="utf8">

		<title><?= $title ?></title>

		<meta name="description" content="<?= $desc ?>">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<link rel="stylesheet" href="css/styles.css">

		<link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">

		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<script src="ckeditor/ckeditor.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>


</head>

<body>

<div class="container-fluid">
	<div class="row" id="logo">

		<div class= "col-md-4" >
			<a href="./"><img src="img/logo.png" height="125" width="500"></a>
		</div>

		<div class="col-md-4">
			<div id="follow-us">
			<p><strong>Follow Us On:</strong></p>	
			</div>

			<div id="icon">
				<i class="fa fa-facebook-official" aria-hidden="true"></i>
				<i class="fa fa-twitter" aria-hidden="true"></i>
				<i class="fa fa-envelope-o" aria-hidden="true"></i>
				<i class="fa fa-pinterest-square" aria-hidden="true"></i>
				<i class="fa fa-google-plus-square" aria-hidden="true"></i>
				<div id="social">
				<?= $this->insert('nav-search') ?>
				</div>
			</div>
		</div>

		

		<div class="col-md-4">
			<?= $this->insert('nav') ?>
		</div>
	</div>
</div>


		
<?php echo $this->insert('bar') ?>



<?php echo $this->section('content') ?>

<footer>
	<div class="fluid-container">
		<div class="row" id="footer-background">
				
			<div class= "col-md-4">
				<div class="why-change" id="address">
							<address>
								  <strong>DIY Home Cleaning</strong><br>
								  129 California Drive<br>
								 Totara Park<br>
								  <abbr title="Phone">Ph:</abbr> (04) 456-7890
							</address>

							<address>
								  <strong>Email:</strong><br>
								  <a href="mailto:#">diycleaning@gmail.com</a>
							</address>
				</div>
			</div>

			<div class="col-md-4">
				<div id="navigate">
								<ul class="list-unstyled">
					  			<li><strong>Navigate Our Website</strong></li>
					  			<br>
					  			
					  			<li><a href="index.php?page=about-us">About Us</a></li>
					  			<li><a href="index.php?page=contact-us">Contact Us</a></li>
					  			<li><a href="#">Archived Posts</a></li>
					  			<li><a href="#">Terms and Conditions</a></li>
								</ul>	
				</div>
			</div>

			<div class= "col-md-4">
				<div id="subscribe">
					<form>
						<div>
							<strong>Subscribe To Our Newsletter</strong><br><br>
						</div>

						<div class="form-group align">
						    <label for="exampleInputEmail1">Email address:</label>
						    <input type="email" class="form-control subscribe-list" id="exampleInputEmail1" placeholder="Email">
						</div>

						 <div class="form-group">
						    <label class="subscribe-list" for="exampleInputPassword1">First Name:</label>
						    <input type="first-name" class="form-control subscribe-list" id="exampleInputPassword1" placeholder="First Name">
						</div>

						  <div class="form-group">
						    <label class="subscribe-list" for="exampleInputPassword1">Last Name:</label>
						    <input type="last-name" class="form-control subscribe-list" id="exampleInputPassword1" placeholder="Last Name">
						</div>
						  
						  <button type="submit" >Subscribe</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</footer>
</body>
		
<!-- Large modal -->


<div class="modal fade bs-example-modal-lg login-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

    	<form id="drop-box" action="what-to-clean.php?page=what-to-clean" method="post">
    		<h2>Log In</h2>

		  <div class="enter-details">
		    <label><b>Email</b></label>
		    <input type="text" placeholder="Email Address" name="email" value="<?= isset($_POST['email']) ? $_POST ['email'] : '' ?>">

			<label><b>Password</b></label>
		    <input type="password" placeholder="Enter Password" name="password" value="<?= isset($_POST['password']) ? $_POST ['password'] : '' ?>">
			
			<button type="submit" name="new-account">Login</button>
		    <input type="checkbox" checked="checked"> Remember me
		  </div>

		  <div class="enter-details">
		    <button type="button" class="cancelbtn" data-dismiss="modal" aria-label="Close">Cancel</button>
		    <span class="psw">Forgot <a href="#">password?</a></span>
		  </div>
		</form>
      
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg signup-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

     <form id="sign-up-details" action="index.php?page=signup" method="post">

     	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     	
     	<h2>Sign Up</h2>
     	<div class="form-group">
		    <label for="first-name">First Name</label>
		    <input type="text" class="form-control" id="first-name" placeholder="First Name" name="first-name" value="<?= isset($_POST['first-name']) ? $_POST ['first-name'] : '' ?>">
		  	<span id="name-message"></span>
		  </div>

		   
		  <div class="form-group">
		    <label for="last-name">Last Name</label>
		    <input type="text" class="form-control" id="last-name" placeholder="First Name" name="last-name" value="<?= isset($_POST['last-name']) ? $_POST ['last-name'] : '' ?>">
		  	<span id="last-name-message"></span>
		  </div>

		   
		  <div class="form-group">
		    <label for="exampleInputEmail1"> Your Email address</label>
		    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= isset($_POST['email']) ? $_POST ['email'] : '' ?>">
		  	<span id="email-name-message"></span>
		  </div>

		  
		  <div class="form-group">
		    <label for="exampleInputPassword1">Enter Password</label>
		    <input type="password" class="form-control" id="password-first" placeholder="Password" name="password" value="<?= isset($_POST['password']) ? $_POST ['password'] : '' ?>">
		  	<span id="password-name-message"></span>
		  </div>

		 <div class="form-group">
		    <label for="exampleInputPassword1">Confirm Password</label>
		    <input type="password" class="form-control" id="password-confirm" placeholder="Password" name="password-confirm" value="<?= isset($_POST['password']) ? $_POST ['password'] : '' ?>">
		  	<span id="password-confirm-message"></span>
		  </div>
		  
		  <input type="hidden" name="signup-submit">
		  <input type="submit" class="btn btn-default" value="Submit">
		  <span id="form-message" class="messages"></span>

	</form>
    </div>
  </div>
</div>


<script src="js/pattern.js"></script>
<script src="js/validation.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript">
	$('.carousel').carousel();
</script>
</body>
</html>