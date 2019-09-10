<?php 

try{
	$db = new PDO('mysql:host=localhost;dbname=ngbath', 'root','root');
	$db-> setAttribute(PDO::ATTR_ERRMODE, ATTR_EXCEPTION);
	$db-> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8'");
}catch(PDOException $e){
die('Erreur :' .$e-> getMessage());
	};
?>

