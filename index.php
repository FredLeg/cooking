<?php
include_once 'partials/header.php';

//$random_recipes = Recipe::getList('*', '', array(), 'RAND()', 3);
$random_recipes = Recipe::select('SELECT * FROM recipe ORDER BY RAND() LIMIT 3');
?>
		<div class="row">
			<div class="col-lg-4">
				<img class="img-circle" src="img/cake.png" alt="Les gateaux" width="140" height="140">
				<h2>Les gateaux</h2>
				<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
				<p><a class="btn btn-default" href="recipes.php?type=1" role="button">Voir les recettes &raquo;</a></p>
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4">
				<img class="img-circle" src="img/burger.png" alt="La fast-food" width="140" height="140">
				<h2>La fast-food</h2>
				<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
				<p><a class="btn btn-default" href="recipes.php?type=2" role="button">Voir les recettes &raquo;</a></p>
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4">
				<img class="img-circle" src="img/soup.png" alt="Les soupes" width="128" height="128">
				<h2>Les soupes</h2>
				<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
				<p><a class="btn btn-default" href="recipes.php?type=3" role="button">Voir les recettes &raquo;</a></p>
			</div><!-- /.col-lg-4 -->
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

<?php include_once 'partials/footer.php'; ?>