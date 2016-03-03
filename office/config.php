<?php
define('DB_DRIVER', 'mysqli');

// Environment
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	//echo 'This is a server using Windows!';
	define('DB_HOSTNAME', '192.168.1.120');
	define('DB_USERNAME', 'lively');
	define('DB_PASSWORD', 'jingjian');
	define('DB_DATABASE', 'ads');

} else {
	//echo 'This is a server not using Windows!';
	define('DB_HOSTNAME', 'localhost');
	define('DB_USERNAME', 'gt_lively');
	define('DB_PASSWORD', 'jingjian#2015P');
	define('DB_DATABASE', 'xmads');

}
define('DB_PREFIX', 'ad_');



?>