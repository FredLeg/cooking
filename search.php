<?php
include_once 'config/config.conf.php';

$count      = 0; // nombre de produits trouvés
$sep        = '/[\s,]+/'; // séparateur de keywords: n'importe quels espaces et la virgule

// Valeurs par défaut du formulaire
$keywords  = [];
$recipe    = '';
$price_min = 20;  //
$price_max = 80;  // Parceque c'est'c'que ch'fais dans la vie
$picture   = '0';
$sort      = 'name';
$direction = 'ASC';

//Types de recherches
$recherche_rapide  = !empty( $_GET['search']);
$recherche_avancee = isset(  $_GET['type']);


if ( $recherche_rapide ) {

	$keywords = preg_split($sep, $_GET['search'] );
	$sql_keys = '';
	foreach($keywords as $key) $sql_keys .= ' AND CONCAT(title,ingredients,content) LIKE \'%'.$key.'%\' ';
	$sql = 'SELECT * FROM recipe WHERE TRUE '
	      .$sql_keys.' ORDER BY title';
	/*Utils::debug($keywords);*/
	/*echo '<pre>'.$sql.'</pre>';*/
	// Résultat de recherche rapide
	$recipes  = Recipe::getList( $sql );
	$count    = count($recipes);
	/*Utils::debug( $recipes );*/
}


$on_a_trouve_des_produits = $count > 0;




include_once 'partials/header.php';
?>
		<h1>Recherche</h1>

		<hr>

		<form class="form-inline" action="search.php" method="GET">

			<input type="hidden" name="advanced_search" value="1">

			<div class="form-group">
				<label for="recipe">Nom de recette</label>
				<input type="text" id="recipe" name="recipe" class="form-control" placeholder="Tarte à la framboise" value="<?= $recipe ?>">
			</div>

			<div class="form-group">
				<label for="type">Type de recette</label>
				<select id="type" name="type" class="form-control">
					<option value="">...</option>
					<option value="1">Gateau</option>
					<option value="2">Fast-food</option>
					<option value="3">Soupe</option>
				</select>
			</div>

			<div class="form-group">
				<label for="ingredient">Ingredient</label>
				<select id="ingredient" name="ingredient" class="form-control">
					<option value="">...</option>
				</select>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Rechercher
				</button>
			</div>
		</form>

<?php
		if ( $on_a_trouve_des_produits ) {

            foreach($recipes as $recipe) {
                echo $recipe->title.'<br/>';
            }
        }

include_once 'partials/footer.php';
