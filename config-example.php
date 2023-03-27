<?php
include_once('include/eloquent/Database.php');
include_once('include/eloquent/Paginator.php');

define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_HOST', '');
define('BASE_URL', __DIR__);

$dsn	= 	"mysql:dbname=".DB_NAME.";host=".DB_HOST."";
$pdo	=	"";
try {
	$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
}catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
$db 	=	new Database($pdo);
$pages	=	new Paginator();

