<?php
include_once 'config/config.conf.php';
$recipes    = Recipe::getList('SELECT * FROM recipe');

include_once 'partials/header.php';
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
		function one(){
			global $recipe;
			?>
			<div class="col-md-7">
				<h2 class="featurette-heading"><?= $recipe->title ?></h2>
				<p class="lead"><?= Utils::cutString($recipe->content, 200) ?></p>
				<a class="btn btn-primary" href="recipe.php?id=<?= $recipe->id ?>" role="button">Voir la recette &raquo;</a>
			</div>
			<?php
		}
		function two(){
			global $recipe;
			?>
			<div class="col-md-5">
				<img class="featurette-image img-responsive center-block" src="img/<?= $recipe->picture ?>" height="333" width="500" alt="">
			</div>
			<?php
		}
		foreach($recipes as $index => $recipe):
			?>
			<div class="row featurette">
				<?= $index%2==0 ? one().two() : two().one(); ?>
			</div>
			<?php
		endforeach;

include_once 'partials/footer.php';
