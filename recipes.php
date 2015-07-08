<?php
include_once 'config/config.conf.php';
$recipes = Recipe::getList('SELECT * FROM recipe');


include_once 'partials/header.php';
?>

		<h1>Les recettes de [RECIPE_TYPE]</h1>


		<hr>

<?php foreach($recipes as $recipe): ?>

		<div class="media">
			<div class="media-left">
				<a href="#">
					<img class="media-object" src="img/<?= $recipe->picture ?>" width="100" height="100" alt="...">
				</a>
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?= $recipe->title ?></h4>
				<blockquote>
					<?= Utils::cutString( $recipe->content, 500) ?><br>
					<a href="recipe.php?id=<?= $recipe->id ?>">Voir la recette</a>
				</blockquote>
			</div>
		</div>

		<hr>
<?php endforeach; ?>

<?php include_once 'partials/footer.php'; ?>