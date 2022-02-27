<?php
$dsn = 'mysql:dbname=biblioteca-asahel;host=localhost';
$user = 'root';
$password = '';

try {
	$miPDO = new PDO($dsn,$user,$password);
	$miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch(PDOException $e) {
	echo "ERROR: ".$e->getMessage();
	die();

}


?>