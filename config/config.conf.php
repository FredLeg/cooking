<?php
// @FIXME
//require_once 'inc/db.php';
//require_once 'inc/func.php';

global $protocol, $domain, $current_dir, $root_path, $root_dir;
$protocol = (@$_SERVER['HTTPS'] == 'on' ? 'https' : 'http'); // http
$domain = $_SERVER['HTTP_HOST']; // localhost
$current_dir = dirname($_SERVER['PHP_SELF']); // jdc
$current_path = $protocol.'://'.$domain.$current_dir; // http://localhost/jdc/admin/
$root_dir = str_replace(array('\\', 'config'), array('/', ''), __DIR__); // C:/xampp/htdocs/jdc/
$root_path = $protocol.'://'.$domain.'/'.str_replace($_SERVER['DOCUMENT_ROOT'], '', $root_dir); // http://localhost/jdc/

require_once 'autoload.conf.php';
