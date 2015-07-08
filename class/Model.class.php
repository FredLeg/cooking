<?php
abstract class Model {

	protected $id;

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
		$query = Db::getInstance()->prepare('SELECT * FROM '.$entity.' WHERE id = :id');
		$query->bindValue('id', $id, PDO::PARAM_INT);
		$query->execute();
		if ($query->rowCount() == 0) {
			throw new Exception(ucfirst($entity).' not found from db with id = '.$id);
		}
		return new $entity($query->fetch());
	}

	public static function getList($select = '*', $from = '', $where = array(), $order = '', $limit = 0) {

		$sql  = 'SELECT '.$select;
		$sql .= ' FROM '.(!empty($from) ? $from : get_called_class());
		$sql .= ' WHERE 1';

		$bindings = array();
		foreach($where as $key => $params) {
			$operator = $params[0];
			$value = $params[1];

			$sql .= ' AND '.$key.' '.$operator.' '.$value;
			$bindings[$key] = $value;
		}

		if (!empty($order)) {
			$sql .= ' ORDER BY '.$order;
		}

		if (!empty($limit)) {
			$sql .= ' LIMIT :limit';
			$bindings['limit'] = $limit;
		}

		$query = Db::getInstance()->prepare($sql);
		foreach($bindings as $key => $value) {
			$type = is_numeric($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
			$query->bindValue($key, $value, $type);
		}
		$query->execute();
		$result = $query->fetchAll();

		return self::_getList($result);
	}

	private static function _getList($result) {
		$recipes = array();
		foreach($result as $recipe) {
			$recipes[] = new Recipe($recipe);
		}
		return $recipes;
	}

}