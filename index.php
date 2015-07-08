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

	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img class="first-slide" src="img/slide-cake.jpg" alt="Les gateaux">
				<div class="container">
					<div class="carousel-caption">
						<h1>Recettes de gateaux</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><a class="btn btn-lg btn-primary" href="recipes.php?type=1" role="button">Voir les recettes</a></p>
					</div>
				</div>
			</div>
			<div class="item">
				<img class="second-slide" src="img/slide-fast-food.jpg" alt="La fast-food">
				<div class="container">
					<div class="carousel-caption">
						<h1>Recettes de fast-food</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><a class="btn btn-lg btn-primary" href="recipes.php?type=2" role="button">Voir les recettes</a></p>
					</div>
				</div>
			</div>
			<div class="item">
				<img class="third-slide" src="img/slide-soup.jpg" alt="Les soupes">
				<div class="container">
					<div class="carousel-caption">
						<h1>Recettes de soupe</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><a class="btn btn-lg btn-primary" href="recipes.php?type=3" role="button">Voir les recettes</a></p>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div><!-- /.carousel -->

	<div class="container marketing">

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

		<div class="row featurette">
			<div class="col-md-7">
				<h2 class="featurette-heading">Recipe title</h2>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in felis magna. Donec arcu ipsum, commodo non sollicitudin at, ultrices sit amet metus. </p>
				<a class="btn btn-primary" href="recipe.php" role="button">Voir la recette &raquo;</a>
			</div>
			<div class="col-md-5">
				<img class="featurette-image img-responsive center-block" src="img/recipe.png" height="333" width="500" alt="">
			</div>
		</div>

		<div class="row featurette">
			<div class="col-md-5">
				<img class="featurette-image img-responsive center-block" src="img/recipe.png" height="333" width="500" alt="">
			</div>
			<div class="col-md-7">
				<h2 class="featurette-heading">Recipe title</h2>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in felis magna. Donec arcu ipsum, commodo non sollicitudin at, ultrices sit amet metus. </p>
				<a class="btn btn-primary" href="recipe.php" role="button">Voir la recette &raquo;</a>
			</div>
		</div>

		<div class="row featurette">
			<div class="col-md-7">
				<h2 class="featurette-heading">Recipe title</h2>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in felis magna. Donec arcu ipsum, commodo non sollicitudin at, ultrices sit amet metus. </p>
				<a class="btn btn-primary" href="recipe.php" role="button">Voir la recette &raquo;</a>
			</div>
			<div class="col-md-5">
				<img class="featurette-image img-responsive center-block" src="img/recipe.png" height="333" width="500" alt="">
			</div>
		</div>

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