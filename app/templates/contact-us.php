<?php 

	$this->layout ('master', [
		'title'=>'DIY Home Cleaning Contact Details',
		'desc'=>'Contact us to find out more about great diy cleaning products for the home'
	]) 

?>
<main>
	<div class="container">
		<div class="row">
			 <div id="contact-heading" class="col-xs-12 center-image">
			 	<h1>Contact Us</h1>
			 	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate possimus est nisi necessitatibus corporis, deserunt, ad nihil nemo error doloremque eligendi neque nam quas explicabo ratione totam placeat consequatur commodi.</p>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			 <div class="col-xs-6">
			 	<form id="query-form">
				  <div class="form-group">
				    <label for="first-name">First Name:</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" name=first-name value="<?= isset($_POST['first-name']) ? $_POST ['first-name'] : '' ?>">
				  </div>
				  <div class="form-group">
				    <label for="last-name">Last Name:</label>
				    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Last Name" name="last-name value="<?= isset($_POST['last-name']) ? $_POST ['last-name'] : '' ?>"">
				  </div>
				  <div class="form-group">
				    <label for="email">Email:</label>
				    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email Address" name="email" value="<?= isset($_POST['email']) ? $_POST ['email'] : '' ?>">
				  </div>
				  <div class="form-group">
				    <label for="subject">Subject:</label>
				    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Subject" name="subject" value="<?= isset($_POST['subject']) ? $_POST ['subject'] : '' ?>">
				  </div>
				  <div class="form-group">
				  	<label for="message">Message:</label>
				  	<textarea class="form-control ckeditor" rows="6"></textarea>
				  </div>
				 <div class="form-group">	
				  <button type="submit" class="btn btn-default">Submit</button>
				  </div>
				</form>
			</div>

			<div id="contact-address" class="col-xs-6 center-image">
		 		<address>
				  <strong>DIY Green Cleaning</strong><br>
				  139 California Drive<br>
				  Totara Park<br>
				  <abbr title="Phone">Ph:</abbr> (04) 456-7890
				</address>

				<img src="img/contact-us/map.png" height=400 width=400 alt="map">
			</div>
		</div>
	</div>

		