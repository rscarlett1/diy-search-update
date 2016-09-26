<?php 

	$this->layout('master',[
		'title'=>'Search',
		'desc'=>'Search Results'
	]);

 ?>

<main>

	<h1>Search Results for "<i><?= $this->e( $searchTerm ) ?></i>"</h1>

<?php if(strlen($searchTerm) > 0): ?>
	<?php if($searchResults > 0): ?>
		<?php foreach($searchResults as $Result): ?>

			<h3><a href="index.php?page=fullrecipepage&recipe_id=<?= $this->e($Result['recipe_id']) ?>"><?= $this->e($Result['score_title']) ?></a></h3>
			<div>
			<?= $Result['score_description'] ?>
			</div>
			<hr>
		<?php endforeach; ?>
	<?php else: ?>
		<p>There was no results for "<i><?= $this->e($searchTerm) ?></i>"</p>
	<?php endif; ?>
<?php else: ?>
	<p>Please put something into the search bar</p>
<?php endif; ?>