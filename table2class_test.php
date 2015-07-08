<?php

require_once 'config/config.conf.php';

try {

	$recipe = new Recipe();
	$recipe->id = 1;
	echo $recipe->id.'<br><br>';

	$recipe = Recipe::get(2);
	echo $recipe->ingredients.'<br><br>';

	$list = $recipe->getList('SELECT * FROM recipe');
	print_r( $list );

} catch(Exception $e) {
	echo  $e->getMessage();
}