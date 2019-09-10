

<?php 
// REFERENCE A LA BASSE DE DONNEES 


// ZONE STRICTEMENT RESERVER ----***** MERCI DE NE PAS MODIFIER// TOUS DROIT RESERVER;
function db($localhost,$dbnom,$user,$mdp){
define('HOST_DB',"mysql:host=$localhost;dbname=$dbnom");
define('HOST_USER',$user);
define('HOST_PASS',$mdp);
class HOST{
  public static $HOST = HOST_DB;
  public static $USER = HOST_USER;
  public static $PASS = HOST_PASS;

};

}

?>