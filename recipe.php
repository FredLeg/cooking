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

		<div class="media">
			<div class="media-left">
				<img src="img/recipe.png" width="300">
			</div>
			<div class="media-body">
				<h1>Recipe title</h1>
				<em>08/07/2015</em>

				<hr>

				<h2>Ingrédients</h2>
				<p>
					- Ut et diam<br>
					- Maecenas gravida augue<br>
					- Proin lacinia massa<br>
					- Proin bibendum mi<br>
					- In vitae mi<br>
					- Cras imperdiet purus<br>
				</p>

				<hr>
				<blockquote>
					Sed faucibus mauris at nisl auctor, quis tempus nunc tristique.<br><br>
					Proin non lacus sed arcu eleifend interdum. Ut sodales neque at convallis congue.<br><br>
					Aliquam tempor nisi id tellus hendrerit, ut tincidunt neque venenatis. Donec congue tempor nulla, sit amet tincidunt purus sollicitudin vel.<br><br>
					Nam rutrum sodales sollicitudin. Cras pharetra, metus eget dapibus porta, elit odio imperdiet lacus.<br><br>
					Sed vulputate justo risus sit amet augue.
				</blockquote>
			</div>
		</div>

		<footer>
			<p class="pull-right"><a href="#">Haut de page</a></p>
			<p>&copy; 2014 Quick Cooking</p>
		</footer>

	</div><!-- /.container -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

</body>
</html>