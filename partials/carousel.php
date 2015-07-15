
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
<?php for($i=0; $i<count($categories); $i++): ?>
			<li data-target="#myCarousel" data-slide-to="<?= $i ?>"<?= ($i==0?' class="active"':'') ?>></li>
<?php endfor; ?>
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
