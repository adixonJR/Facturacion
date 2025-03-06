<?php
// -- Zona Horaria
date_default_timezone_set('America/Lima');
// --
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https://";
} else {
    $protocol = "http://";
}
// --
$base_url =  $protocol . $_SERVER['HTTP_HOST'] .  '/demo/facturacion/'; //<--Direccion HTTP
// --
define('BASE_URL', $base_url);
define('DEFAULT_CONTROLLER', 'Login');
define('DEFAULT_LAYOUT', 'layout');
// --
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_gliese');
<<<<<<< HEAD
define('DB_PORT', 3307);
=======
define('DB_PORT', 3306);
>>>>>>> 274942dea46fca33cbed907a631f1daf8ffbc740
