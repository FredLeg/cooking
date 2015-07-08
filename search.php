<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="img/favicon.ico">

	<title>Quick Cooking</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link href="css/styles.css" rel="stylesheet">

</head>
<body>
	<div class="navbar-wrapper">
		<div class="container">

			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php">Quick Cooking</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a href="index.php">Accueil</a></li>
							<li><a href="random.php">Recette aléatoire</a></li>
							<li><a href="search.php">Recherche</a></li>
							<li><a href="contact.php">Contact</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Les recettes <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="recipes.php?type=1">Les gateaux</a></li>
									<li><a href="recipes.php?type=2">La fast-food</a></li>
									<li><a href="recipes.php?type=3">Les soupes</a></li>
								</ul>
							</li>
						</ul>
						<form class="navbar-form navbar-right" action="search.php" method="GET">
							<div class="input-group">
								<input name="search" type="text" class="form-control" placeholder="Recherche rapide...">
								<span class="input-group-btn">
									<button class="btn btn-default" type="submit">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</nav>

		</div>
	</div>

	<div class="container marketing">

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

		<hr>

		<footer>
			<p class="pull-right"><a href="#">Haut de page</a></p>
			<p>&copy; 2014 Quick Cooking</p>
		</footer>

	</div><!-- /.container -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

</body>
</html>