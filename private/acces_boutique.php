

<?php 
// REFERENCE A LA BASSE DE DONNEES 


// ZONE STRICTEMENT RESERVER ----***** MERCI DE NE PAS MODIFIER// TOUS DROIT RESERVER;
define('HOST_DB',"mysql:host=127.0.0.1;dbname=vetechdesign_boutique");
define('HOST_USER',"root");
define('HOST_PASS',"");

class HOST{
  public static $HOST = HOST_DB;
  public static $USER = HOST_USER;
  public static $PASS = HOST_PASS;

};

?>