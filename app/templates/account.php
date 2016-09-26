<?php 

	$this->layout('master', [
		'title'=>'Your account',
		'desc'=>'Change your contact deails'
	]);

?>

<main>
<article>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 image-align-center" id="">
				<form action="index.php?page=account" id="account-details" method="post">
		 				<div class="row container">
			    			<div class="col-xs-12 image-align-center" >
			    				<h1 id="heading-acc">Account Profile</h1>	
				
								<h2>Update your contact details</h2>

								<div class="form-group">
									<label for="">First Name: </label>
									<input class="form-control" type="text" name="first-name" value="<?= isset($_POST['first-name']) ? $_POST['first-name'] : '' ?>">
								</div>
								<br>                            

								<?= isset($firstNameMessage) ? $firstNameMessage : '' ?>

								<div class="form-group">	
								<label for="">Last Name: </label>
								<input class="form-control" type="text" name="last-name" value="<?= isset($_POST['last-name']) ? $_POST['last-name'] : '' ?>">
								</div>
								<br>

								<?= isset($lastNameMessage) ? $lastNameMessage : '' ?>

								<input type="submit" id="profile-button"class="btn btn-default" name="update-contact" value="Update Your Details">
								<?= isset($postMessage) ? $postMessage : '' ?>
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>	
</article>
<br>
<br>
</br>

<article>
	<div class="container">
	  <div class="row">
	    <div class="col-xs-12" id="kitchen-posts">
	    	
	    		<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" name="new-recipe" id="recipe-post" enctype="multipart/form-data">

	    		<h2 class="upload-header">Upload Your Own DIY Cleaning Recipes</h2>
		    		<div class="form-group">
		    			<label for="title">Title: </label>
		    			<input class="form-control" type="text" name="recipe-title" id="recipe-title" value="<?= isset($_POST['recipe-title']) ? $_POST['recipe-title'] : '' ?>">
		    			<?= isset($titleMessage) ? $titleMessage : '' ?>

		    		</div>
	    	
<div class="form-group">
	<label for="desc">Description: </label>
	<textarea class="form-control ckeditor" name="recipe-desc" cols"5" rows="10"><?= isset($_POST['submit-recipe']) ? $_POST['recipe-desc'] : '' ?></textarea>
	<?= isset($descMessage) ? $descMessage : '' ?>
</div>

					<div class="form-group">
						<label for="method">Method</label>
						<textarea  class="form-control ckeditor" name="recipe-methods" cols"80" rows="10"><?= isset($_POST['recipe-methods']) ? $_POST['recipe-methods'] : '' ?></textarea>
						<?= isset($methodMessage) ? $methodMessage : '' ?>
					</div>


					<div class="form-group">
						<label name="image" for="image">Image</label>
		    			<input  class="form-control" type="file" name="image" id="image">
		    			<?= isset($imageMessage) ? $imageMessage : '' ?>
					</div>

					
					<div class="form-group">
					<input class="btn btn-default" type="submit" name="submit-recipe" value="Submit">
					<?= isset($recipeUploadMessage) ? $recipeUploadMessage : '' ?>
					</div>
				</form>
	    	</div>	
		</div>
	</div>
</article>


