<?php
require_once 'config/config.conf.php';
header('Content-Type: text/html; charset=utf-8');
###############################################################################
###########  Utilisation  #####################################################
if(empty($_GET['table'])) {
	echo 'Paramètre: <a href="'.$_SERVER['PHP_SELF'].'?table=recipe">?table=recipe</a>'.'<br>';
	echo "table: Nom de la table pour laquelle on veut une class".'<br>';
	echo '<a href="'.$_SERVER['PHP_SELF'].'?table=recipe&nos">&nos</a>: Supprime le s du nom de la table (ici, y\'en a pas)'.'<br>';
	echo "Utilise:".'<br>';
	echo " - Utils::getCamelCase".'<br>';
	echo " - Db::getInstance';".'<br>';
	echo "(ce fichier doit rester en utf-8)".'<br>';
	exit;
}
########### Test du Timer #####################################################
$myTime = Timer::start();
//$nbLoops = 50000;while ($nbLoops--) 5164897451*16997134815;
usleep(100000);// en microsecondes
echo 'Timer: '.$myTime->stop().'&nbsp;seconde<br>';
########### Les columnMeta ####################################################
$db = Db::getInstance();
$rs = $db->query('SELECT * FROM recipe LIMIT 0');
$metas = [];
$i = $rs->columnCount();
while ( $i-- ) {
    $meta = $rs->getColumnMeta($i);
    $name = $meta['name'];
    unset($meta['name']); unset($meta['table']);
    $metas[$name] = $meta;
}
Utils::debug($metas);
###############################################################################
###############################################################################
define ('¶',PHP_EOL);  // Alt+0182
$table_name = $_GET['table'];      // Nom de la table pour laquelle on veut une class
$nos        = isset($_GET['nos']); // Pour "no S": Supprime le s du nom de la class
$class_name = ucfirst($nos ? substr($table_name,0,strlen($table_name)-1) : $table_name);
function getCamelCase($str) {
	return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
}
$fields = []; $infos = [];
$db = Db::getInstance();
$rows  = $db->query('DESC '.$table_name)->fetchAll();
Utils::debug( $rows );
$max_id_length = 0;
foreach( $rows as $index => $row ) {
	$infos[$row['Field']] = '';
	foreach( $row as $key => $value ) {
		if ($key=='Field') {
			$fields[] = $value;
			$max_id_length = max($max_id_length,strlen($value));
		} else {
			if(!empty($value)) $infos[$row['Field']] .= $key.':'.$value.', ';
		}
	}
}
########### RegEx sur types mySQL ############################################
// "^(((float|decimal|double)(\\([[:digit:]]+,[[:digit:]]+\\))?))$"
/*
SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE FROM information_schema.columns;
DATA_TYPE returns - decimal
COLUMN_TYPE returns - decimal(5,2)
*/
$arr = [ 'int(11) unsigned', 'int' ];
$pattern = "/
    ([a-zA-Z\s]+)  # tout caractère entre a-z et A-Z et espaces blancs, au moins une fois
    ([a-zA-Z\s(),]*)            # parenthèse ouvrante
/x";
foreach($arr as $txt){
	//$arr = explode ('(', $txt);
	preg_match ($pattern , $txt, $matches);
	echo '<b>'.$txt.'</b>:<br>';
	Utils::debug($matches);
}
###############################################################################
echo '<pre class="prettyprint lang-php">';
//echo '<?php'.¶;
echo 'class '.$class_name.' {'.¶;
echo ¶;
echo '	############ Attributs'.¶;
echo ¶;
foreach( $fields as $field ) {
	$align = str_repeat( ' ', $max_id_length - strlen($field)+1 );
echo '	private $'.$field.'; '.$align.' // '.$infos[$field].¶;
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
foreach( $fields as $key => $field ) {
	$function_name = Utils::getCamelCase('get'.ucfirst($field));
	switch ( $rows[$key]['Type'] ) {
		case 'datetime':
echo '	public function '.$function_name.'($format = \'d-m-Y H:i:s\') {'.¶;
echo '		if (empty($format)) {'.¶;
echo '			$format = \'Y-m-d H:i:s\';'.¶;
echo '		}'.¶;
echo '		return date($format, strtotime($this->'.$field.'));'.¶;
echo '	}'.¶;
		break;
		case 'text':
echo '	public function '.$function_name.'() {'.¶;
echo '		return nl2br(htmlspecialchars($this->'.$field.'));'.¶;
echo '	}'.¶;
		break;
		default:
echo '	public function '.$function_name.'(){;'.¶;
echo '		return $this->'.$field.';'.¶;
echo '	}'.¶;
	}
}
echo ¶;
echo '	############ Setters'.¶;
echo ¶;
foreach( $fields as $key => $field ) {
	$function_name = Utils::getCamelCase('set'.ucfirst($field));
	switch ( $rows[$key]['Type'] ) {
		case 'datetime':
echo '	public function '.$function_name.'($'.$field.') {'.¶;
echo '		if (strtotime($'.$field.') === false) {'.¶;
echo '			throw new Exception("Creation date must be valid");'.¶;
echo '		}'.¶;
echo '		$this->'.$field.' = $'.$field.';'.¶;
echo '	}'.¶;
		break;
		case 'text':
echo '	public function '.$function_name.'($'.$field.') {'.¶;
echo '		if (empty($'.$field.') || strlen($'.$field.') > 65536) {'.¶;
echo '			throw new Exception("Content cannot be empty and 65536 length max");'.¶;
echo '		}'.¶;
echo '		$this->'.$field.' = $'.$field.';'.¶;
echo '	}'.¶;
		break;
		default:
echo '	public function '.$function_name.'($'.$field.'){'.¶;
echo '		$this->'.$field.' = $'.$field.';'.¶;
echo '	}'.¶;
	}
}
echo '	public function __toString() {'.¶;
echo '		return $this;'.¶;
echo '	}'.¶;
echo '}'.¶;
echo '</pre>'.¶;
echo '<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>'.¶;
########### Temsp de fabrication de la page ###################################
echo "Création de page en ".Timer::pageLoad()." seconde";
