<?php
include_once 'config/config.conf.php';
$categories = Category::getList('SELECT * FROM category LIMIT 3');

include_once 'partials/header.php';
?>
	<div class="media">

		erreur <?= $_GET[0] ?>

	</div>

<?php
include_once 'partials/footer.php';
