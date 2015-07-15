<?php
class Recipe extends Model {

	public $id;
	public $type;
	public $title;
	public $ingredients;
	public $content;
	public $picture;
	public $date;

	/* Setters */
	public function setId($id) {
		if (!is_numeric($id) || $id < 0) {
			throw new Exception('Recipe id must be a number > 0');
		}
		$this->id = $id;
	}
	public function setType($type) {
		if (!is_numeric($type) || $type < 0 || $type > 99) {
			throw new Exception('Recipe type must be a number between 0 and 99');
		}
		$this->type = $type;
	}
	public function setTitle($title) {
		if (empty($title) || !is_string($title) || strlen($title) > 100) {
			throw new Exception('Recipe title must be a string and 100 chars max');
		}
		$this->title = $title;
	}
	public function setIngredients($ingredients) {
		if (!is_string($ingredients) && strlen($ingredients) >  65536) {
			throw new Exception('Recipe ingredients must be a string and 65536 chars max');
		}
		$this->ingredients = $ingredients;
	}
	public function setContent($content) {
		if (!is_string($content) && strlen($content) >  65536) {
			throw new Exception('Recipe content must be a string and 65536 chars max');
		}
		$this->content = $content;
	}
	public function setPicture($picture) {
		if (!is_string($picture) || strlen($picture) > 100) {
			throw new Exception('Recipe picture must be a string and 100 chars max');
		}
		$this->picture = $picture;
	}
	public function setDate($date) {
		if (strtotime($date) === false) {
			throw new Exception('Recipe date format must be Y-m-d H:i:s');
		}
		$this->date = $date;
	}

	/* Getters */
	public function getId() {
		return $this->id;
	}
	public function getType() {
		return $this->type;
	}
	public function getTitle() {
		return ucfirst($this->title);
	}
	public function getIngredients() {
		return nl2br($this->ingredients);
	}
	public function getContent($max_length = 0, $end = '...') {
		return nl2br(Utils::cutString($this->content, $max_length, $end));
	}
	public function getPicture() {
		$picture = 'img/recipe.png';
		if (!empty($this->picture)) {
			$path = 'img/'.$this->picture;
			if (file_exists($path)) {
				return $path;
			}
		}
		return $picture;
	}
	public function getDate($format = 'Y-m-d H:i:s') {
		return date($format, strtotime($this->date));
	}

	/* Display */
	public static function displayHomeBlock($recipe, $i = 0) {

		$first = '<div class="col-md-7">
			<h2 class="featurette-heading">'.$recipe->getTitle().'</h2>
			<p class="lead">
				'.$recipe->getContent(50).'
			</p>
			<a class="btn btn-primary" href="recipe.php?id='.$recipe->getId().'" role="button">Voir la recette &raquo;</a>
		</div>';

		$second = '<div class="col-md-5">
			<img class="featurette-image img-responsive center-block" src="'.$recipe->getPicture().'" height="333" width="500" alt="">
		</div>';

		return $i % 2 === 0 ? $first.PHP_EOL.$second : $second.PHP_EOL.$first;
	}

}