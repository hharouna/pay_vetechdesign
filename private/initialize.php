<?php

// Perform all initialization here, in private

// Set constants to easily reference public 
// and private directories
define("APP_ROOT", dirname(dirname(__FILE__)));
define("PRIVATE_PATH", APP_ROOT . "/private");
define("PUBLIC_PATH", APP_ROOT . "/public");
require_once(PRIVATE_PATH . "/passwords.php");
require_once(PRIVATE_PATH . "/db_connection.php");
require_once(PRIVATE_PATH . "/functions.php");

?>
