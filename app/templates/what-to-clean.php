<?php 

	$this->layout('master', [
		'title'=>'Choose what area in your house you would like to clean',
		'desc'=>'categories of areas i the house you would like to clean'
	]);
?>

<main>
	
	<div class="container"> <!-- container -->
		<div class="row images-wwyltc" >
			 <div class="col-xs-6 center-image bgimages" id="bathroom-image">
				<a href="index.php?page=recipes&type=Bathroom"><h1 class="image-height">Bathroom</h1></a>
			</div>

			<div class="col-xs-6 center-image bgimages" id="kitchen-image">
				<a href="index.php?page=recipes&type=Kitchen"><h1 class="image-height">Kitchen</h1>
			</div></a>
		</div>

		<div class="row images-wwyltc">
			<div class="col-xs-6 center-image" id="laundry-image">
			<a href="index.php?page=recipes&type=Laundry"><h1 class="image-height ">Laundry</h1></a>
			</div>
			
			<div class="col-xs-6 center-images" id="garage-image">
			<a href="index.php?page=recipes&type=Garage"><h1 class="image-height">Garage</h1></a>
			</div>
		</div>

		<div class="row images-wwyltc">
			<div class="col-xs-12 bgimages" id="other-areas-image">
			<a href="index.php?page=recipes&type=Other"><h1 class="image-height" id="move-heading">Other Areas</h1>
			</div>
		</div>
	</div>

