<?php

class Db extends PDO {

	const ENGINE = 'mysql';
	const HOST 	 = 'localhost';
	const USER   = 'root';
	const PASS   = '';
	const DB     = 'cooking';

	private static $_db_options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    );

	private static $instance;

	public function __construct($database) {
		parent::__construct(self::ENGINE.':dbname='.$database.";host=".self::HOST, self::USER, self::PASS, self::$_db_options);
    }

	public static function getInstance($database = null) {
		$database = !empty($database) ? $database : self::DB;
		if(!isset(self::$instance)) {
			self::$instance = new Db($database);
		}
		return self::$instance;
	}

	private static function _query($sql, $bindings = array()) {
		$query = self::getInstance()->prepare($sql);
		foreach($bindings as $key => $value) {
			$type = is_numeric($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
			$query->bindValue($key, $value, $type);
		}
		$query->execute();
		return $query;
	}

	public static function selectOne($sql, $bindings = array()) {
		$query = self::_query($sql, $bindings);
		return $query->fetch();
	}

	public static function select($sql, $bindings = array()) {
		$query = self::_query($sql, $bindings);
		return $query->fetchAll();
	}

	public static function insert($sql, $bindings = array()) {
		$query = self::_query($sql, $bindings);
		return self::getInstance()->lastInsertId();
	}

	public static function update($sql, $bindings = array()) {
		$query = self::_query($sql, $bindings);
		return $query->rowCount();
	}

	public static function delete($sql, $bindings = array()) {
		return self::update();
	}
}