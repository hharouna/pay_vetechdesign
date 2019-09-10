<?php 

/* controle sesssion paiment vetechdesign*/

/*  controle GET */


/*
extrat GET
*/

extract($_GET);
/*
include et requiere once 
*/
include_once('../private/indexinclude.php'); 
require_once('../private/connect_db.php'); 

session_pay();

$url_base64 = base64_decode($url); 

$_exploide = explode('&',$url_base64);
/*
liste des urls

*/

				$url_validation="https://pay.vetechdesign.net"; //https://pay.vetechdesign.net
				$url_active="https://pay.vetechdesign.net"; //https://pay.vetechdesign.net
				$url_retour="https://vetechdesign.net"; 
				$url_vetech="https://vetechdesign.net"; 
				/*
				controle

	echo $id_session;
	echo $id_etudiant;
	echo $id_chapitre;
	echo $id_forma;
	echo $f_montant;
	echo $f_participant;
	$__exploide.'
            &'.$resselectform['f_idformation'].'
            &'.$resselectform['f_idchapitre'].'
            &'.$resselectform['f_idforma'].'*/ 
    $controle_array=array(
	":id_etudiant_session_pay"=>$_exploide[1],
	":id_session_form_pay"=>$_exploide[0],
	":id_form_idforma"=>$_exploide[3],
	":id_module_sesspay"=>$_exploide[2],
	":active_pay"=> "1"
	);  	

//var_dump($controle_array);
	$controle_sql= ' SELECT 
	* 
	FROM
	pay_session 
	WHERE   
		id_etudiant_session_pay =:id_etudiant_session_pay
		AND id_session_form_pay =:id_session_form_pay
		AND  id_form_idforma=:id_form_idforma
		AND  id_module_sesspay=:id_module_sesspay
		AND  active_pay =:active_pay  '; 
	$sql_affiche = $db->prepare($controle_sql);
	$sql_affiche->execute($controle_array);
	$controle_count= $sql_affiche->rowCount(); 
	$controle_fecth = $sql_affiche->fetch(); 
	
//var_dump($controle_array);

//echo $controle_count;
//exit(); 

	 $controle = $_exploide[7] ; 

	if(isset($controle)&& $controle_count <= 0 ): 

 

	$_SESSION["ID_SESSION"] =$_exploide[0];
	$_SESSION["MAIL"] =$_exploide[6];
	$_SESSION["F_MONTANT"] =$_exploide[4];
	$_SESSION["ID_FORMATION"] =$_exploide[1];
	$_SESSION["ID_CHAPTRE"] =$_exploide[2];
	$_SESSION["ID_FORMA"] =$_exploide[3];
	$_SESSION["CONTROLE"] =$_exploide[7];
    $_SESSION["NOM"] =$_exploide[8];
	$_SESSION["PRENOM"] =$_exploide[9];
	$_SESSION["TITRE_FORMATION"] =$_exploide[10];
	$_SESSION["TITRE_MODULE"] =$_exploide[11];
	$_SESSION["DUREE"] =$_exploide[12];
	$_SESSION["DATE_SESSION"] =$_exploide[13];
	$_SESSION["H_SESSION"] =$_exploide[14];
	$_SESSION["M_SESSION"] =$_exploide[15];
   
    header("location:".$url_validation.""); 

	echo $controle ; 
exit;
	 
	//fermerdure des sessions en cours pay 
	//session_write_close();										
	elseif(isset($controle)&& $controle_fecth['active_pay']==1 && $controle_count > 0): 
	
	
	$_SESSION["ID_SESSION"] =$_exploide[0];
	$_SESSION["MAIL"] =$_exploide[6];
	$_SESSION["F_MONTANT"] =$_exploide[4];
	$_SESSION["ID_FORMATION"] =$_exploide[1];
	$_SESSION["ID_CHAPTRE"] =$_exploide[2];
	$_SESSION["ID_FORMA"] =$_exploide[3];
	$_SESSION["CONTROLE"] =$_exploide[7];
    $_SESSION["NOM"] =$_exploide[8];
	$_SESSION["PRENOM"] =$_exploide[9];
	$_SESSION["TITRE_FORMATION"] =$_exploide[10];
	$_SESSION["TITRE_MODULE"] =$_exploide[11];
	$_SESSION["DUREE"] =$_exploide[12];
	$_SESSION["DATE_SESSION"] =$_exploide[13];
	$_SESSION["H_SESSION"] =$_exploide[14];
	$_SESSION["M_SESSION"] =$_exploide[15];
    $_SESSION["id_cinetpay_retour"] =$controle_fecth['id_cinetpay_retour']; 
	
	header("location: ".$url_active."/controle/active.php"); 
	
	elseif(isset($controle)&& $controle_fecth['active_pay']==2 ): 
	header("location: ".$url_active."/controle/active.php"); 
	else:  
	

	header("location:".$url_vetech); 
	
	endif;
	
	




?>