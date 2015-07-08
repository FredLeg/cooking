<?php
include_once 'partials/header.php';

?>
		<h1>Recherche</h1>

		<hr>

		<form class="form-inline" action="search.php" method="GET">

			<input type="hidden" name="advanced_search" value="1">

			<div class="form-group">
				<label for="recipe">Nom de recette</label>
				<input type="text" id="recipe" name="recipe" class="form-control" placeholder="Tarte à la framboise" value="">
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

<?php include_once 'partials/footer.php'; ?>