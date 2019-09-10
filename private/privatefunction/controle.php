<?php 

function db($dbnom){

  $pdo = "'mysql:host=localhost;dbname=".$dbnom.", 'root','root'";
  return $pdo; 
}
$dbname = 'ngbath';
$c= new PDO(db($dbname));


  foreach($c->query('SELECT * FROM infovb ') as $value) {
    echo $value[4].'</br>';
	
	
	
	
}
 ?>
