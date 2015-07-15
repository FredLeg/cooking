<?php
require_once 'config/config.conf.php';

echo 'dir -- ',           'DIR -- ',           __DIR__.'<br>';
echo 'protocol -- ',      'HTTPS -- ',         @$_SERVER['HTTPS'].'<br>';
echo 'domain -- ',        'HTTP_HOST -- ',     $_SERVER['HTTP_HOST'].'<br>';
echo 'current_dir -- ',   'PHP_SELF -- ',      $_SERVER['PHP_SELF'].'<br>';
echo 'document_root -- ', 'DOCUMENT_ROOT -- ', $_SERVER['DOCUMENT_ROOT'].'<br>';
echo 'script -- ', 'SCRIPT_FILENAME -- ', $_SERVER['SCRIPT_FILENAME'].'<br>';
echo 'file -- ',          'FILE -- ',          __FILE__.'<br>';
Utils::debug( get_included_files() );
echo '<br>';

require_once 'class/dev_class_diir.php';
