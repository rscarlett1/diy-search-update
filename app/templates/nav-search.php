<!-- When you are Logged In -->
<?php if(isset($_SESSION['user_id'])): ?>

<div class="container" id="search-bar">	
	<div class="row col-xs-4" >
		<form action="index.php?page=search" class="navbar-form navbar-left" method="post">
			<input type="text" name="search" class="form-control ckeditor" placeholder="Search for Recipes">
			 
			 <input type="submit" class="btn btn-primary btn-sm">
		</form>
	</div>
</div>

<?php endif; ?>

