<?php
include_once 'config/config.conf.php';
$recipe     = Recipe::getRandom( 'SELECT * FROM recipe ORDER BY RAND() LIMIT 1' );

include_once 'partials/header.php';


include_once 'partials/recipe.php';


include_once 'partials/footer.php';
