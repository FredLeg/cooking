
		<div class="media">
			<div class="media-left">
				<img src="img/<?= (strlen($recipe->picture)>0?$recipe->picture:'recipe.png') ?>" width="300"/>
			</div>
			<div class="media-body">
				<h1><?= $recipe->title ?></h1>
				<em><?= $recipe->date ?></em>

				<hr>

				<h2>Ingrédients</h2>
				<p>
				<?= nl2br($recipe->ingredients) ?>
				</p>

				<hr>
				<blockquote>
					<?= $recipe->content ?>
				</blockquote>
			</div>
		</div>
