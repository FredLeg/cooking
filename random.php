<?php
include_once 'config/config.conf.php';
$recipe     = Recipe::get( $_GET['id'] ); // <<<<<<<<<<<<<<<

include_once 'partials/header.php';


include_once 'partials/recipe.php';


include_once 'partials/footer.php';
