<?php
include_once 'config/config.conf.php';
if(empty($_GET['id'])) {
	header('Location: index.php');
	exit();
}
$recipe     = Recipe::get( $_GET['id'] );

include_once 'partials/header.php';


/*
echo '('.empty($recipe->picture).') '.gettype($recipe->picture).': '.$recipe->picture.'<br/>';
$a = '';
$b = 'hello';
echo empty($a).'<br/>';
echo empty($b).'<br/>';
echo strlen($recipe->picture).'<br/>';
*/
include_once 'partials/recipe.php';



include_once 'partials/footer.php';
