<?php

class Category {

	############ Attributs

	private $id;            // Type:int(11), Null:NO, Key:PRI, Extra:auto_increment,
	private $name;          // Type:varchar(40), Null:NO,
	private $image;         // Type:varchar(20), Null:NO,
	private $description;   // Type:text, Null:NO,

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
		$query = Db::getInstance()->prepare('SELECT * FROM category WHERE id = :id');
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
	public static function getRandom($sql) {
		$posts = self::getList($sql);
		return $posts[0];
	}

	############ Getters

	public function getId(){;
		return $this->id;
	}
	public function getName(){;
		return $this->name;
	}
	public function getImage(){;
		return $this->image;
	}
	public function getDescription() {
		return nl2br(htmlspecialchars($this->description));
	}

	############ Setters

	public function setId($id){
		$this->id = $id;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function setImage($image){
		$this->image = $image;
	}
	public function setDescription($description) {
		if (empty($description) || strlen($description) > 65536) {
			throw new Exception("Content cannot be empty and 65536 length max");
		}
		$this->description = $description;
	}
	public function __toString() {
		return $this;
	}
}