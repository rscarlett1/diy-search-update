<?php 

    $this->layout ('master', [
        'title'=>'Recipe Upload page',
        'desc'=>'displays an uploaded image'
    ]); 
?>


<main>

<div class="container">
  <div class="row">
      <!-- foreach Loop -->
      <?php foreach($fullrecipepage as $fullrecipepage): ?>
          <div class=" col-xs-12 col-sm-12 col-md-12">
            <div class="thumbnail">

            <h1><?= $fullrecipepage['title'] ?> </h1>
            <p><?= $fullrecipepage['description'] ?></p>
            <p><?= $fullrecipepage['method'] ?></p>

            <img img class="img-responsive" src="<?= $item['image'] ?>" alt="...">
      
            <div class="caption">
                <p>Posted By:<?= $fullrecipepage['first_name'].' '.$fullrecipepage['last_name'] ?></p>
            </div>
        </div>
      </div>
  </div> 
      <?php endforeach; ?>
  </div>
