<?php
abstract class Model {

	// Par défaut on défini l'argument $data facultatif et vide par défaut, ce qui permet de continuer à instancier l'objet avec new Movie() en utilisant les setters manuellement
    public function __construct($data = array())    {

    	// Pour chaque élément du tableau $data
        foreach ($data as $key => $value) {
            // On défini une variable pour reconstituer le nom d'un setter avec la clé issue du tableau $data
            $method = Utils::getCamelCase('set'.ucfirst($key)); // Ex: setTitle

            // Si le setter existe dans la classe
            if (method_exists($this, $method)) {

                // On appelle le setter et on lui passe la valeur issue du tableau $data
                $this->$method($value); // Ex: $this->setTitle('Star Wars');
            }
        }
    }

    public function __set($key, $value) {
			$method = Utils::getCamelCase('set'.ucfirst($key)); // Ex: setTitle
		if (method_exists($this, $method)) {
			$this->$method($value);
		}
	}

	public function __get($key) {
		$method = Utils::getCamelCase('get'.ucfirst($key)); // Ex: getTitle
		if (method_exists($this, $method)) {
			return $this->$method();
		}
	}

	public static function get($id) {
		$entity = get_called_class();

		$result = Db::selectOne('SELECT * FROM '.$entity.' WHERE id = :id', array('id' => $id));
		if (count($result) == 0) {
			throw new Exception(ucfirst($entity).' not found from db with id = '.$id);
		}
		return new $entity($result);
	}

	public static function getRandom() {
		return self::getList('*', '', array(), 'RAND()', 3);
	}

	public static function getList($select = '*', $from = '', $where = array(), $order = '', $limit = 0) {

		$sql  = 'SELECT '.$select;
		$sql .= ' FROM '.(!empty($from) ? $from : get_called_class());
		$sql .= ' WHERE 1';

		$bindings = array();
		foreach($where as $key => $params) {
			$operator = $params[0];
			$value = $params[1];

			$sql .= ' AND '.$key.' '.$operator.' :'.$key;
			$bindings[$key] = $value;
		}

		if (!empty($order)) {
			$sql .= ' ORDER BY '.$order;
		}

		if (!empty($limit)) {
			$sql .= ' LIMIT :limit';
			$bindings['limit'] = $limit;
		}

		$result = Db::select($sql, $bindings);

		return self::_getList($result);
	}

	private static function _getList($result) {
		$entity = get_called_class();
		$items = array();
		foreach($result as $item) {
			$items[] = new $entity($item);
		}
		return $items;
	}

	public static function select($sql, $bindings = array()) {
		return self::_getList(Db::select($sql, $bindings));
	}
	public static function selectOne($sql, $bindings = array()) {
		$entity = get_called_class();
		return new static(Db::selectOne($sql, $bindings));
	}

	public function __toString() {
		return '<pre>'.print_r($this, true).'</pre>';
	}
}