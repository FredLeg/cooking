<?php
class Recipe {

	############ Attributs

	private $id;            // Type:int(11), Null:NO, Key:PRI, Extra:auto_increment,
	private $type;          // Type:tinyint(2), Null:NO,
	private $title;         // Type:varchar(100), Null:NO,
	private $ingredients;   // Type:text, Null:NO,
	private $content;       // Type:text, Null:NO,
	private $picture;       // Type:varchar(100), Null:YES,
	private $date;          // Type:datetime, Null:YES,

	############ Magique

	public function __construct($data = array())    {
		foreach ($data as $key => $value) {
			$method = Utils::getCamelCase('set'.ucfirst($key));
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}
	public function __set($key, $value) {
		$method = Utils::getCamelCase('set'.ucfirst($key));
		if (method_exists($this, $method)) {
			$this->$method($value);
		}
	}
	public function __get($key) {
		$method = Utils::getCamelCase('get'.ucfirst($key));
		if (method_exists($this, $method)) {
			return $this->$method();
		}
	}

	############ Utils

	public static function get($id) {
		if (empty($id))	{
			return false;
		}
		$query = Db::getInstance()->prepare('SELECT * FROM recipe WHERE id = :id');
		$query->bindValue('id', $id, PDO::PARAM_INT);
		$query->execute();
		return new self($query->fetch());
	}

	public static function getList($sql) {
		$result   = Db::getInstance()->query($sql)->fetchAll();
		$response = array();
		foreach($result as $item) {
			$response[] = new self($item);
		}
		return $response;
	}

	############ Getters

	public function getId(){;
		return $this->id;
	}
	public function getType(){;
		return $this->type;
	}
	public function getTitle(){;
		return $this->title;
	}
	public function getIngredients() {
		return nl2br(htmlspecialchars($this->ingredients));
	}
	public function getContent() {
		return nl2br(htmlspecialchars($this->content));
	}
	public function getPicture(){;
		return $this->picture;
	}
	public function getDate($format = 'd-m-Y H:i:s') {
		if (empty($format)) {
			$format = 'Y-m-d H:i:s';
		}
		return date($format, strtotime($this->date));
	}

	############ Setters

	public function setId($id){
		$this->id = $id;
	}
	public function setType($type){
		$this->type = $type;
	}
	public function setTitle($title){
		$this->title = $title;
	}
	public function setIngredients($ingredients) {
		if (empty($ingredients) || strlen($ingredients) > 65536) {
			throw new Exception("Content cannot be empty and 65536 length max");
		}
		$this->ingredients = $ingredients;
	}
	public function setContent($content) {
		if (empty($content) || strlen($content) > 65536) {
			throw new Exception("Content cannot be empty and 65536 length max");
		}
		$this->content = $content;
	}
	public function setPicture($picture){
		$this->picture = $picture;
	}
	public function setDate($date) {
		if (strtotime($date) === false) {
			throw new Exception("Creation date must be valid");
		}
		$this->date = $date;
	}
	public function __toString() {
		return '<pre>'.print_r($this, true).'</pre>';
	}
}