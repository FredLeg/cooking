<?php
include_once 'partials/header.php';

//$random_recipes = Recipe::getList('*', '', array(), 'RAND()', 3);
$random_recipes = Recipe::select('SELECT * FROM recipe ORDER BY RAND() LIMIT 3');
?>
		<div class="row">
			<?php
			foreach($categories as $categorie):
				?>
				<div class="col-lg-4">
					<img class="img-circle" src="img/<?= $categorie->image ?>" alt="<?= $categorie->name ?>" width="140" height="140">
					<h2><?= $categorie->name ?></h2>
					<p><?= $categorie->description ?></p>
					<p><a class="btn btn-default" href="recipes.php?type=<?= $categorie->id ?>" role="button">Voir les recettes &raquo;</a></p>
				</div><!-- /.col-lg-4 -->
				<?php
			endforeach;
			?>
		</div><!-- /.row -->
		<hr class="featurette-divider">
		<?php
		$i = 0;
		foreach($random_recipes as $recipe) {
		?>
		<div class="row featurette">
			<?= Recipe::displayHomeBlock($recipe, $i++); ?>
		</div>
		<?php }	?>

<?php
include_once 'partials/footer.php';
?>