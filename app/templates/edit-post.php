<?php 

    $this->layout ('master', [
        'title'=>'Edit recipe post',
        'desc'=>'Edit the post page that you uploaded to the webpage'
    ]);
 ?>

<main>

<article>
	<div class="container edit-post">
	  <div class="row">
	    <div class="col-xs-12" id="kitchen-posts">
	    	<h1>Edit post: <?= htmlentities($originalTitle) ?></h1>
	    		<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" name="edit-post" id="edit-post" enctype="multipart/form-data"> 

	    		
		    		<div class="form-group">
		    			<label for="title">Title: </label>
		    			<input  class="form-control" type="text" name="title" id="title" value="<?= $post['title'] ?>">
		    			<?= isset($titleError) ? $titleError : '' ?>

		    		</div>
		    	
					<div class="form-group">
						<label for"desc">Description</label>
						<textarea  class="form-control ckeditor" id="desc" name="description" cols"5" rows="10"><?= $post['description'] ?></textarea>
						<?= isset($descError) ? $descError : '' ?>
					</div>

					<div class="form-group">

						<label for"method">Method</label>
						
						<textarea class="form-control ckeditor" id="method" name="method" cols"80" rows="10"><?= $post['method'] ?></textarea>
						<?= isset($methodError) ? $methodError : '' ?>
					</div>

					
					<div class="form-group">
						<img id="edit-image" src="img/uploads/recipes/<?= $post['image'] ?>" name="image" for="image">
						<input type="file" name="image">
					</div>

					
					<div class="form-group">
					<input class="btn btn-default" type="submit" name="edit-post" value="Submit">
					<?= isset($updateError) ? $updateError : '' ?>
					</div>
				</form>
	    	</div>	
		</div>
	</div>
</article>