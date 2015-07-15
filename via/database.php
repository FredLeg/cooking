<?php
require_once '../config/config.conf.php';
require_once 'partials/header.php';
###############################################################################

$db = Db::getInstance();
$result  = $db->query('SHOW TABLES');

while ( $table_name = $result->fetch(PDO::FETCH_NUM)[0] ) {
    echo '<a href="?tbl='.$table_name.'">'.$table_name.'</a><br/>';
}

$table_name = !empty($_GET['tbl']) ? $_GET['tbl'] : '';
if (!empty($table_name)) {
	?>
	<script type="text/javascript" src="inc/jquery/jquery-1.7.2.js"></script>
	<script type="text/javascript" src="inc/jquery/ui/js/jquery-ui-1.8.20.custom.min.js"></script>
	<link   type="text/css"       href="inc/jquery/ui/css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="inc/jquery/ui.tinytbl/jquery.ui.tinytbl.js"></script>
	<link   type="text/css"       href="inc/jquery/ui.tinytbl/jquery.ui.tinytbl.css" rel="stylesheet" />
	<script type="text/javascript" src="inc/smartable/jquery.smartable.js"></script>
	<link   type="text/css"       href="inc/smartable/grille.css" rel="stylesheet" />
	<style>
		.highlight td {
			background-color: Highlight !important;
			}
		.rowselected {
			background-color: #FFCC99 !important;
			}
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
			// Table resizable
			$('div.grille').resizable({ autoHide: true });
			$('table.grille').smartable({ // attention, il y a aussi un div.grille
				rowhighlight: true,
				rowhighlightclass:'highlight_grille',
				addrowselector: true,
				colresizable: true,
				colresizablehandle: true
			});
		});
		var debug = true;
		function writeInConsole (text) {
			if ( !debug ){ return; }
			if (typeof console !== 'undefined') {
				console.log(text);
			} else {
				alert(text);
			}
		}
	</script>
	<?php
	echo "\n\n".'<div class="grille" style="height:200px;width:100%">'."\n";
	echo '<div class="inner">'."\n";
	echo '<table class="grille">'."\n";
	echo '<caption>Données de la table '.$table_name.'</caption>'."\n";
	echo '<thead>'."\n";
	echo '<tr>';
	$rows  = $db->query('DESC '.$table_name)->fetchAll();
	foreach( $rows as $index => $row ) {
		echo '<th>'.$row['Field'].'</th>';
	}
	echo '</tr>'."\n";
	echo '<thead>'."\n";
	echo '<tbody>'."\n";
	$rows  = $db->query( 'SELECT * FROM '.$table_name )->fetchAll();
	foreach( $rows as $i_row => $row ){
		echo '<tr>';
		foreach( $row as $i_field => $field ){
			echo '<td>'.$field.'</td>';
		}
		echo '</tr>'."\n";
	}
	echo '</tbody>'."\n";
	echo '</table>'."\n";
	echo '<div class="footer" style="width:50px; height:10%"></div>'."\n";
	echo '</div>'."\n";
	echo '</div>'."\n";
}
/*
$sql = <<<EOF
DROP TABLE IF EXISTS `category`;

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `image` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `name`, `image`, `description`) VALUES
(1, 'Les gateaux', 'cake.png', 'Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.'),
(2, 'La fast-food', 'burger.png', 'Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.'),
(3, 'Les soupes', 'soup.png', 'Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.');

ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
EOF;
$result  = $db->exec( $sql );
*/

###############################################################################
require_once 'partials/footer.php';
