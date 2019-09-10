<?php 



// function define
include("acces_db.php");
//$connect = new HOST();

	
		
		try{
			$db = new PDO(HOST::$HOST, HOST::$USER, HOST::$PASS);
			$db-> setAttribute(PDO::ATTR_ERRMODE, ATTR_EXCEPTION);
			$db-> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'UTF8'");
		   }
		catch(PDOException $e){
		die('Erreur :' .$e-> getMessage());
			};

?>

