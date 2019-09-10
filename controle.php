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
	*/
    $controle_array=array(
	":id_etudiant_session_pay"=>$id_etudiant,
	":id_session_form_pay"=>$id_forma,
	":id_form_idforma"=>$id_chapitre,
	":id_module_sesspay"=>$id_session,
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

	
	if(isset($controle)&& $controle_count <= 0 ): 


	$_SESSION["ID_SESSION"] =$id_session;
	$_SESSION["MAIL"] =$mail;
	$_SESSION["F_MONTANT"] =$f_montant;
	$_SESSION["ID_FORMATION"] =$id_etudiant;
	$_SESSION["ID_CHAPTRE"] =$id_chapitre;
	$_SESSION["ID_FORMA"] =$id_forma;
	$_SESSION["CONTROLE"] =$controle;
    $_SESSION["NOM"] =$f_nom;
	$_SESSION["PRENOM"] =$f_prenom;
	$_SESSION["TITRE_FORMATION"] =$f_titrefromation;
	$_SESSION["TITRE_MODULE"] =$f_titremodule;
	$_SESSION["DUREE"] =$f_duree;
	$_SESSION["DATE_SESSION"] =$f_date_session;
	$_SESSION["H_SESSION"] =$f_h;
	$_SESSION["M_SESSION"] =$f_m;
   
    header("location:".$url_validation.""); 

	
	 
	//fermerdure des sessions en cours pay 
	//session_write_close();										
	elseif(isset($controle)&& $controle_fecth['active_pay']==1 && $controle_count > 0): 
	
	$_SESSION["ID_SESSION"] =$id_session;
	$_SESSION["MAIL"] =$mail;
	$_SESSION["F_MONTANT"] =$f_montant;
	$_SESSION["ID_FORMATION"] =$id_etudiant;
	$_SESSION["ID_CHAPTRE"] =$id_chapitre;
	$_SESSION["ID_FORMA"] =$id_forma;
	$_SESSION["CONTROLE"] =$controle;
    $_SESSION["NOM"] =$f_nom;
	$_SESSION["PRENOM"] =$f_prenom;
	$_SESSION["TITRE_FORMATION"] =$f_titrefromation;
	$_SESSION["TITRE_MODULE"] =$f_titremodule;
	$_SESSION["DUREE"] =$f_duree;
	$_SESSION["DATE_SESSION"] =$f_date_session;
	$_SESSION["H_SESSION"] =$f_h;
	$_SESSION["M_SESSION"] =$f_m;
    $_SESSION["id_cinetpay_retour"] =$controle_fecth['id_cinetpay_retour']; 
	
	header("location: ".$url_active."/controle/active.php"); 
	
	elseif(isset($controle)&& $controle_fecth['active_pay']==2 ): 
	header("location: ".$url_active."/controle/active.php"); 
	else:  
	

	header("location:".$url_vetech); 
	
	endif;
	
	




?>