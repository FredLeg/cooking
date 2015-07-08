<?php
require_once 'config/config.conf.php';
###############################################################################
#########################  Utilisation  #######################################
if(empty($_GET['table'])) {
	echo "Paramètre /?table=recipe".'<br>';
	echo "table: Nom de la table pour laquelle on veut une class".'<br>';
	echo "&nos: Supprime le s du nom de la class".'<br>';
	echo "Utilise:".'<br>';
	echo " - Utils::getCamelCase".'<br>';
	echo " - Db::getInstance';".'<br>';
	echo "(ce fichier doit rester en utf-8)".'<br>';
	exit;
}
###############################################################################
###############################################################################
//define ('P',PHP_EOL);
define ('¶',PHP_EOL);  // Alt+0182
$table_name = $_GET['table'];      // Nom de la table pour laquelle on veut une class
$nos        = isset($_GET['nos']); // Pour "no S": Supprime le s du nom de la class
$class_name = $nos ? substr($table_name,0,strlen($table_name)-1) : $table_name;
$class_name = ucfirst($class_name);
function tab($n){return str_repeat("\t",$n);}
function getCamelCase($str) {
	return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
}
$fields = []; $infos = [];
$db = Db::getInstance();
$posts  = $db->query('DESC '.$table_name)->fetchAll();
$max_id_length = 0;
foreach( $posts as $post ) {
	$infos[$post['Field']] = '';
	foreach( $post as $key => $value ) {
		if ($key=='Field') {
			$fields[] = $value;
			$max_id_length = max($max_id_length,strlen($value));
		} else {
			if(!empty($value)) $infos[$post['Field']] .= $key.':'.$value.', ';
		}
	}
}
###############################################################################
echo '<xmp>'.¶;
echo '<?php'.¶;
echo 'class '.$class_name.' {'.¶;
echo ¶;
echo '	############ Attributs'.¶;
echo ¶;
foreach( $posts as $post ) {
	foreach( $post as $key => $value ) {
		if ($key=='Field'){
			$align = str_repeat( ' ', $max_id_length - strlen($value)+1 );
echo '	private $'.$value.'; '.$align.' // '.$infos[$value].¶;
		}
	}
}
echo ¶;
echo '	############ Magique'.¶;
echo ¶;
echo '	public function __construct($data = array())    {'.¶;
echo '		foreach ($data as $key => $value) {'.¶;
echo '			$method = Utils::getCamelCase(\'set\'.ucfirst($key));'.¶;
echo '			if (method_exists($this, $method)) {'.¶;
echo '				$this->$method($value);'.¶;
echo '			}'.¶;
echo '		}'.¶;
echo '	}'.¶;
echo '	public function __set($key, $value) {'.¶;
echo '		$method = Utils::getCamelCase(\'set\'.ucfirst($key));'.¶;
echo '		if (method_exists($this, $method)) {'.¶;
echo '			$this->$method($value);'.¶;
echo '		}'.¶;
echo '	}'.¶;
echo '	public function __get($key) {'.¶;
echo '		$method = Utils::getCamelCase(\'get\'.ucfirst($key));'.¶;
echo '		if (method_exists($this, $method)) {'.¶;
echo '			return $this->$method();'.¶;
echo '		}'.¶;
echo '	}'.¶;
echo ¶;
echo '	############ Utils'.¶;
echo ¶;
echo '	public static function get($id) {'.¶;
echo '		if (empty($id))	{'.¶;
echo '			return false;'.¶;
echo '		}'.¶;
echo '		$query = Db::getInstance()->prepare(\'SELECT * FROM '.$table_name.' WHERE id = :id\');'.¶;
echo '		$query->bindValue(\'id\', $id, PDO::PARAM_INT);'.¶;
echo '		$query->execute();'.¶;
echo '		return new self($query->fetch());'.¶;
echo '	}'.¶;
echo ¶;
echo '	public static function getList($sql) {'.¶;
echo '		$result   = Db::getInstance()->query($sql)->fetchAll();'.¶;
echo '		$response = array();'.¶;
echo '		foreach($result as $item) {'.¶;
echo '			$response[] = new self($item);'.¶;
echo '		}'.¶;
echo '		return $response;'.¶;
echo '	}'.¶;
echo '	public static function getRandom($sql) {'.¶;
echo '		$posts = self::getList($sql);'.¶;
echo '		return $posts[0];'.¶;
echo '	}'.¶;
echo ¶;
echo '	############ Getters'.¶;
echo ¶;
foreach( $fields as $key => $value ) {
	$function_name = Utils::getCamelCase('get'.ucfirst($value));
	switch ( $posts[$key]['Type'] ) {
		case 'datetime':
echo '	public function '.$function_name.'($format = \'d-m-Y H:i:s\') {'.¶;
echo '		if (empty($format)) {'.¶;
echo '			$format = \'Y-m-d H:i:s\';'.¶;
echo '		}'.¶;
echo '		return date($format, strtotime($this->'.$value.'));'.¶;
echo '	}'.¶;
		break;
		case 'text':
echo '	public function '.$function_name.'() {'.¶;
echo '		return nl2br(htmlspecialchars($this->'.$value.'));'.¶;
echo '	}'.¶;
		break;
		default:
echo '	public function '.$function_name.'(){;'.¶;
echo '		return $this->'.$value.';'.¶;
echo '	}'.¶;
	}
}
echo ¶;
echo '	############ Setters'.¶;
echo ¶;
foreach( $fields as $key => $value ) {
	$function_name = Utils::getCamelCase('set'.ucfirst($value));
	switch ( $posts[$key]['Type'] ) {
		case 'datetime':
echo '	public function '.$function_name.'($'.$value.') {'.¶;
echo '		if (strtotime($'.$value.') === false) {'.¶;
echo '			throw new Exception("Creation date must be valid");'.¶;
echo '		}'.¶;
echo '		$this->'.$value.' = $'.$value.';'.¶;
echo '	}'.¶;
		break;
		case 'text':
echo '	public function '.$function_name.'($'.$value.') {'.¶;
echo '		if (empty($'.$value.') || strlen($'.$value.') > 65536) {'.¶;
echo '			throw new Exception("Content cannot be empty and 65536 length max");'.¶;
echo '		}'.¶;
echo '		$this->'.$value.' = $'.$value.';'.¶;
echo '	}'.¶;
		break;
		default:
echo '	public function '.$function_name.'($'.$value.'){'.¶;
echo '		$this->'.$value.' = $'.$value.';'.¶;
echo '	}'.¶;
	}
}
echo '	public function __toString() {'.¶;
echo '		return \'<pre>\'.print_r($this, true).\'</pre>\';'.¶;
echo '	}'.¶;
echo '}'.¶;
echo '</xmp>'.¶;
###############################################################################
