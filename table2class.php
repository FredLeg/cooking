<?php
require_once 'config/config.conf.php';
###############################################################################
#########################  Utilisation  #######################################
if(empty($_GET['table'])) {
	header('Content-Type: text/html; charset=utf-8');
	echo "Paramètre: ?table=recipe".'<br>';
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
define ('¶',PHP_EOL);  // Alt+0182
$table_name = $_GET['table'];      // Nom de la table pour laquelle on veut une class
$nos        = isset($_GET['nos']); // Pour "no S": Supprime le s du nom de la class
$class_name = ucfirst($nos ? substr($table_name,0,strlen($table_name)-1) : $table_name);
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
// "^(((float|decimal|double)(\\([[:digit:]]+,[[:digit:]]+\\))?))$"
/*
SELECT TABLE_SCHEMA, TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE FROM information_schema.columns;
DATA_TYPE returns - decimal
COLUMN_TYPE returns - decimal(5,2)
*/
$txt = [ 'int(11)', 'int' ];
$motif = "/
    ([a-zA-Z\s]+)  # tout caractère entre a-z et A-Z et espaces blancs, au moins une fois
    \(             # parenthèse ouvrante
/x";
foreach($txt as $str){
	$arr = explode ('(', $str);
	//preg_match ($motif , $arr[0], $matches);
	echo '<b>'.$str.'</b> '.$arr[0].'<br>';
}
###############################################################################
echo <<<EOF
<pre class="prettyprint lang-php">
	Publishing:commit/stash/push
	git commit -m "message"	Commit the local changes that were staged
	git commit -am "message"	Stage files (modified and deleted, not new) and commit
	git stash	Take the uncommitted work (modified tracked files and staged changes) and saves it
	git stash list	Show list of stashes
	git stash apply	Reapply the latest stashed contents
	git stash apply <stash id>	Reapply a specific stash. (stash id = stash@{2})
	git stash drop <stash id>	Drop a specific stash
	git push	Push your changes to the origin
	git push origin <local branch name>	Push a branch to the origin
	git tag <tag name>	Tag a version (ie v1.0). Useful for Github releases.
</pre>
EOF;
echo '<pre class="prettyprint lang-php">';
//echo '<?php'.¶;
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
echo '		return $this;'.¶;
echo '	}'.¶;
echo '}'.¶;
echo '</pre>'.¶;
echo '<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>'.¶;
###############################################################################
