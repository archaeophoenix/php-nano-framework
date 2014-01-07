<?php
require_once 'config/Config.php';
function __autoload($file) {
	require_once LIBS . $file .".php";
}
$bootstrap = new Bootstrap();
$bootstrap->start();