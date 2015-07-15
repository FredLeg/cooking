<?php
$categories = Category::getList('SELECT * FROM category LIMIT 3');
?>
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
<?php foreach($categories as $category): ?>
									<li><a href="recipes.php?type=<?= $category->id ?>"><?= $category->name ?></a></li>
<?php endforeach; ?>
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