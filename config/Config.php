<?php
$http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://';
$fo = str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);
$base_url = $http . $_SERVER['HTTP_HOST'] . "" . $fo;


define('X',$base_url);
define('LIBS','libs/');

define('header','header');
define('footer','footer');


define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'cvm');
define('DB_USER', 'root');
define('DB_PASS', '');