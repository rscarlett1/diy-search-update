<?php 

    $this->layout ('master', [
        'title'=>'Recipe page',
        'desc'=>'A recipe how to make the cleaner'
    ]); 
?>


<main>
<!--?php var_dump($fullrecipepage) ?>-->

<div class="container">
  <div class="row">
      <!-- foreach Loop -->
      <?php foreach($fullrecipepage as $fullrecipepage): ?>
          <div class=" col-xs-12 col-sm-12 col-md-12">
              <div id="recipe-post"class="thumbnail">

              <div>
                <h1 id="full-recipe-heading">
                <?= ($fullrecipepage['title']) ?></h1>
              </div>
              
              <div>
             <strong><?= ($fullrecipepage['description']) ?></strong>
              </div>
              <br>
              <div>
              <?= ($fullrecipepage['method']) ?>
              </div>

              <img img class="img-responsive" src="img/uploads/post-size/<?= $fullrecipepage['image'] ?>" alt="...">
      
            <div class="caption" id="recipe-edit">
                  <ul>
                    <li><strong>Posted By: </strong><?= htmlentities($fullrecipepage['first_name'].' '.$fullrecipepage['last_name']) ?></li>
                    <?php

                      if( isset($_SESSION['user_id']) ) {

                      if( $_SESSION['user_id'] == $fullrecipepage['user_id'] ){
                          // You own post!
                    ?>
                <li>
                  <button class="btn btn-default post-changes btn-sm"><a href="index.php?page=edit-post&id=<?= $_GET['recipe_id'] ?>">Edit</a></button>
                </li>
                </li>

                <li>
                  <button class="delete-post post-changes btn-sm btn btn-default">Delete</button></a>
                  
                    <div class="delete-post-options">
                      <button class="btn btn-success post-button btn-xs"><a href= "<?= $_SERVER['REQUEST_URI'] ?>&delete">Yes</a></button> / <button class="btn btn-success btn-xs post-button">No</button>
                    </div>
                </li>
                        <?php
                      }

                  }

                ?>
                </ul>
              </div>
          </div>
        </div>
    </div> 
      <?php endforeach; ?>
  </div>


<section>
    <div class="container">
      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12"> 
         
            <form class="form-group" action="index.php?page=fullrecipepage&recipe_id=<?= $_GET['recipe_id'] ?>" method="post">
            
              <h2 id="full-recipe-heading">Comments: (<?= count($allComments) ?>)</h2>
              
                <div class="form-group comments-padding">
                  <label for="comment">Please write a comment: </label>
                  <textarea class="form-control ckeditor" name="comment" id="comment" cols="30" rows="5"></textarea>
                </div>

                <?= isset($commentMessage) ? $commentMessage : '' ?>
              
                <div>
                  <input class="btn btn-default" type="submit" name="new-comment" value="Submit">
                </div>

                <?= isset($recipeCommentMessage) ? $recipeCommentMessage : '' ?>
            </form>


          <?php foreach($allComments as $comment): ?>

            <article id="edit-dot">
                <h2>Posted Comments</h2> 
                <p><?= ($comment['comment']) ?> </p>
                <small>Written by: <?= htmlentities($comment['author']) ?></small>

                <?php
                // Is the visitor logged in?
                if( isset($_SESSION['user_id']) ) {

                // Does this user own the comment?
                if( $_SESSION['user_id'] == $comment['user_id'] || $_SESSION['privilege'] == 'admin' ){
                  
                  ?>
                    <li>
                      <a href="index.php?page=edit-comments&commentid=<?=$comment['id']?>"><button class="btn btn-success post-button btn-xs">Edit</button></a>
                    </li>
                      
                    <li>
                      <a><button class="delete-post btn btn-success post-button btn-xs">Delete</button></a>
                      
                        <div class="delete-post-options">
                          <a href= "<?= $_SERVER['REQUEST_URI'] ?>&deleteComment&commentid=<?=$comment['id']?>">Yes</a> / <button>No</button>
                        </div>

                    </li>
                    <?php

                  }

                }

              ?>

            </article>
                
                <?php endforeach ?>
            </div>
        </div> 
    </div>
</section>

<script>
  

  // Wait for all the stuff to be ready
  $(document).ready(function(){


    //When the user clicks on the delete button
    $('.delete-post, .delete-post-options button').click(function(){

     // Toggle the visibility of the controls
     $('.delete-post-options').toggle();

    });

  });

</script>




