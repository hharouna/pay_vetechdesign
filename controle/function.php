<?php 

include_once("function.php");
include_once('../private/indexinclude.php'); 
require_once('../private/connect_db.php');
function pay_session($id_cinetpay_retour, $id_formation_session_pay, $id_module_form_pay, $id_session_sesspay, $id_etudiant_pay,$id_codepaie_cinetpay, $active_pay, $cpm_trans_id, $info_mail, $pay_db_session ){

    
		//id_etudiant_session_pay 	id_session_form_pay 	id_form_idforma 	id_module_sesspay 	id_codepaie_cinetpay 	active_pay 	date_form_pay 
		$sql_session_pay ='INSERT INTO 
		pay_session(
		id_cinetpay_retour,
		id_etudiant_session_pay,
		id_session_form_pay,
		id_form_idforma,
		id_module_sesspay,
		id_codepaie_cinetpay,
		pay_session_cpm_trans_id,
		active_pay
		)VALUES(
		:id_cinetpay_retour,
		:id_etudiant_session_pay, 
		:id_session_form_pay,
		:id_form_idforma, 
		:id_module_sesspay,
		:id_codepaie_cinetpay,
		:pay_session_cpm_trans_id,
		:active_pay
		)';

		$sql_pay_insert= $pay_db_session->prepare($sql_session_pay);
		$sql_pay_insert->execute(array(
		":id_cinetpay_retour"=>$id_cinetpay_retour,
		":id_etudiant_session_pay"=>$id_etudiant_pay,
		":id_session_form_pay"=>$id_formation_session_pay,
		":id_form_idforma"=>$id_module_form_pay, 
		":id_module_sesspay"=>$id_session_sesspay,
		":id_codepaie_cinetpay"=>$id_codepaie_cinetpay,
		":pay_session_cpm_trans_id"=>$cpm_trans_id,
		":active_pay"=>$active_pay
		));

		$id_session_pay= $pay_db_session->lastInsertId(); 

        $add_session_pay = explode('-',$info_mail);
        $add_session_pay[0];// ID_FORMA  LISTEFORMATION
        $add_session_pay[1];// ID_MODULE CHAPITRE
        $add_session_pay[2];// ID_SESSION SESSION FORMAION
        $add_session_pay[3];// ID_ETUDIANT ID CANDIDAT 
        $add_session_pay[4];// ID_MAIL ADRESS EMAIL DEMANDEUR DE FORMATION 
        $add_session_pay[5];//  NOM require_once("../private/connect_db.php");
		$add_session_pay[6];//  PRENOM
            		recu_pay($add_session_pay[3],$id_session_pay,$id_cinetpay_retour, $pay_db_session );


    }


function insert_session_pay($id_retour_cinetpay, $conn_db_insert_session ){

    //id_etudiant_session_pay 	id_session_form_pay 	id_form_idforma 	id_module_sesspay 	id_codepaie_cinetpay 	active_pay 	date_form_pay 

                $sql_retour_pay = 'SELECT * FROM retour_cinetpay WHERE id_retour_cinetpay=?';
                $retour_pay= $conn_db_insert_session->prepare($sql_retour_pay); 
                $retour_pay->execute(array($id_retour_cinetpay)); 
                $count_pay=  $retour_pay->rowCount();
                $rest_fetch = $retour_pay->fetch(); 
    /*
        		$_SESSION["ID_FORMATION"].'-'.$_SESSION["ID_FORMA"].'-'.$_SESSION["ID_CHAPTRE"].'-'.$_SESSION["ID_SESSION"].'-'.$_SESSION["MAIL"].'-'.
    $_SESSION["NOM"].'-'.$_SESSION["PRENOM"];
    */
        		$add_session_pay= explode('-',$rest_fetch["cpm_custom"]);
                $add_session_pay[0];// ID_FORMA  LISTEFORMATION
                $add_session_pay[1];// ID_MODULE CHAPITRE
                $add_session_pay[2];// ID_SESSION SESSION FORMAION
                $add_session_pay[3];// ID_ETUDIANT ID CANDIDAT 
                $add_session_pay[4];// ID_MAIL ADRESS EMAIL DEMANDEUR DE FORMATION 
                $add_session_pay[5];// NOM 
                $add_session_pay[6];// PRENOM

    if(isset($id_retour_cinetpay)): 
    //$_SESSION["ID_FORMATION"].'-'.$_SESSION["ID_FORMA"].'-'.$_SESSION["ID_CHAPTRE"].'-'.
    //$_SESSION["ID_SESSION"].'-'.$_SESSION["MAIL"].'-'.$_SESSION["NOM"].'-'.$_SESSION["PRENOM"]
    pay_session($id_retour_cinetpay,$add_session_pay[0],$add_session_pay[1],$add_session_pay[2],$add_session_pay[3], $rest_fetch['cpm_payid'],1, $rest_fetch["cpm_trans_id"] ,$rest_fetch["cpm_custom"],  $conn_db_insert_session); 

    endif ; 


    }


function notification_erro($_message,$pmail){


$A = $pmail[4];
$from = "pay@vetechdesign.net"; 
$sujet = 'Erreur de votre paiement: '.$rest_fetch_recu['form']. ' Chapitre : '.$rest_fetch_recu['chapitre']; 
$ptitle_recu = "FORMATION"; 
$comment_recu_pay ="<center><h4 > Erreur de votre paiement </h4> </center>";
cssmail_notif($_message,$pmail[4],$from,$sujet,$ptitle_recu ,$comment_recu_pay,$db_mail );




};


function notification_cinetpay_session($array_cinetpay,$conn_db){
        // $array = array($array_cinetpay);
         // liste des valeurs dans un tableau

        //liste des champs d'insertion dans la basse de donnée
    $sql = 'INSERT INTO retour_cinetpay(
            cpm_site_id,
            cpm_amount,
            cpm_trans_id,
            cpm_trans_date,
            cpm_page_action,
            cpm_payment_config,
            cpm_version,
            cpm_return_mode,
            cpm_result,
            cpm_trans_status,
            cpm_payment_date,
            cpm_payment_time,
            cpm_currency,
            cpm_language,
            cpm_custom,
            signature,
            payment_method,
            cel_phone_num,
            cpm_phone_prefixe,
            cpm_error_message,
            cpm_payid,
            cpm_ipaddr,
            cpm_designation
             ) VALUES ( 
            :cpm_site_id,
            :cpm_amount,
            :cpm_trans_id,
            :cpm_trans_date,
            :cpm_page_action,
            :cpm_payment_config,
            :cpm_version,
            :cpm_return_mode,
            :cpm_result,
            :cpm_trans_status,
            :cpm_payment_date,
            :cpm_payment_time,
            :cpm_currency,
            :cpm_language,
            :cpm_custom,
            :signature,
            :payment_method,
            :cel_phone_num,
            :cpm_phone_prefixe,
            :cpm_error_message,
            :cpm_payid,
            :cpm_ipaddr,
            :cpm_designation)';

        $sql_rout= $conn_db->prepare($sql);
        $sql_rout->execute($array_cinetpay);
        $result_fecth=$sql_rout->fetch(); 
        $idlast_pay_cinetpay= $conn_db->lastInsertId(); 
        insert_session_pay($idlast_pay_cinetpay, $conn_db); 

    }; 

function pay_session_notif($id_cinetpay_retour, $id_formation_session_pay, $id_module_form_pay, $id_session_sesspay, $id_etudiant_pay,$id_codepaie_cinetpay, $active_pay, $cpm_trans_id, $info_mail, $pay_db_session ){

//id_etudiant_session_pay 	id_session_form_pay 	id_form_idforma 	id_module_sesspay 	id_codepaie_cinetpay 	active_pay 	date_form_pay 
//id_etudiant_session_pay 	id_session_form_pay 	id_form_idforma 	id_module_sesspay 	id_codepaie_cinetpay 	active_pay 	date_form_pay 
  
$sql_session_pay ='INSERT INTO 
pay_session(
id_cinetpay_retour,
id_etudiant_session_pay,
id_session_form_pay,
id_form_idforma,
id_module_sesspay,
id_codepaie_cinetpay,
pay_session_cpm_trans_id,
active_pay
)VALUES(
:id_cinetpay_retour,
:id_etudiant_session_pay, 
:id_session_form_pay,
:id_form_idforma, 
:id_module_sesspay,
:id_codepaie_cinetpay,
:pay_session_cpm_trans_id,
:active_pay
)';

$sql_pay_insert= $pay_db_session->prepare($sql_session_pay);
$sql_pay_insert->execute(array(
":id_cinetpay_retour"=>$id_cinetpay_retour,
":id_etudiant_session_pay"=>$id_etudiant_pay,
":id_session_form_pay"=>$id_formation_session_pay,
":id_form_idforma"=>$id_module_form_pay, 
":id_module_sesspay"=>$id_session_sesspay,
":id_codepaie_cinetpay"=>$id_codepaie_cinetpay,
":pay_session_cpm_trans_id"=>$cpm_trans_id,
":active_pay"=>$active_pay
));

$id_session_pay= $pay_db_session->lastInsertId(); 

$add_session_pay = explode('-',$info_mail);
$add_session_pay[0];// ID_FORMA  LISTEFORMATION
$add_session_pay[1];// ID_MODULE CHAPITRE
$add_session_pay[2];// ID_SESSION SESSION FORMAION
$add_session_pay[3];// ID_ETUDIANT ID CANDIDAT 
$add_session_pay[4];// ID_MAIL ADRESS EMAIL DEMANDEUR DE FORMATION 
$add_session_pay[5];//  NOM require_once("../private/connect_db.php");
$add_session_pay[6];//  PRENOM

recu_pay_notif($add_session_pay[3],$id_session_pay,$id_cinetpay_retour, $pay_db_session );


}

function insert_session_notif($id_retour_cinetpay, $conn_db_insert_session ){

    //id_etudiant_session_pay 	id_session_form_pay 	id_form_idforma 	id_module_sesspay 	id_codepaie_cinetpay 	active_pay 	date_form_pay 

                $sql_retour_pay = 'SELECT * FROM retour_cinetpay WHERE id_retour_cinetpay=?';
                $retour_pay= $conn_db_insert_session->prepare($sql_retour_pay); 
                $retour_pay->execute(array($id_retour_cinetpay)); 
                $count_pay=  $retour_pay->rowCount();
                $rest_fetch = $retour_pay->fetch(); 
    /*
                $_SESSION["ID_FORMATION"].'-'.$_SESSION["ID_FORMA"].'-'.$_SESSION["ID_CHAPTRE"].'-'.$_SESSION["ID_SESSION"].'-'.$_SESSION["MAIL"].'-'.
    $_SESSION["NOM"].'-'.$_SESSION["PRENOM"];
    */
                $add_session_pay= explode('-',$rest_fetch["cpm_custom"]);
                $add_session_pay[0];// ID_FORMA  LISTEFORMATION
                $add_session_pay[1];// ID_MODULE CHAPITRE
                $add_session_pay[2];// ID_SESSION SESSION FORMAION
                $add_session_pay[3];// ID_ETUDIANT ID CANDIDAT 
                $add_session_pay[4];// ID_MAIL ADRESS EMAIL DEMANDEUR DE FORMATION 
                $add_session_pay[5];// NOM 
                $add_session_pay[6];// PRENOM

    if(isset($id_retour_cinetpay)): 
    //$_SESSION["ID_FORMATION"].'-'.$_SESSION["ID_FORMA"].'-'.$_SESSION["ID_CHAPTRE"].'-'.
    //$_SESSION["ID_SESSION"].'-'.$_SESSION["MAIL"].'-'.$_SESSION["NOM"].'-'.$_SESSION["PRENOM"]
    pay_session_notif($id_retour_cinetpay,$add_session_pay[0],$add_session_pay[1],$add_session_pay[2],$add_session_pay[3], $rest_fetch['cpm_payid'],1, $rest_fetch["cpm_trans_id"] ,$rest_fetch["cpm_custom"],  $conn_db_insert_session); 

    endif ; 


    }

function notification_cinetpay_notif($array_cinetpay,$conn_db){
	// $array = array($array_cinetpay);
	 // liste des valeurs dans un tableau

  
	$cinet_register_array = array(
	":cpm_site_id"=>$array_cinetpay[':cpm_site_id'],
	":cpm_amount"=>$array_cinetpay[':cpm_amount'],
	":cpm_trans_id"=>$array_cinetpay[':cpm_trans_id'],
	":cpm_trans_date"=>$array_cinetpay[':cpm_trans_date'],
	":cpm_page_action"=>$array_cinetpay[':cpm_page_action'],
	":cpm_payment_config"=>$array_cinetpay[':cpm_payment_config'],
	":cpm_version"=>$array_cinetpay[':cpm_version'],
	":cpm_return_mode"=>$array_cinetpay[':cpm_return_mode'],
	":cpm_result"=>$array_cinetpay[':cpm_result'],
	":cpm_trans_status"=>$array_cinetpay[':cpm_trans_status'],
	":cpm_payment_date"=>$array_cinetpay[':cpm_payment_date'],
	":cpm_payment_time"=>$array_cinetpay['cpm_payment_time'],
	":cpm_currency"=>$array_cinetpay[':cpm_currency'],
	":cpm_language"=>$array_cinetpay[':cpm_language'],
	":cpm_custom"=>$array_cinetpay[':cpm_custom'],
	":signature"=>$array_cinetpay[':signature'],
	":payment_method"=>$array_cinetpay[':payment_method'],
	":cel_phone_num"=>$array_cinetpay[':cel_phone_num'],
	":cpm_phone_prefixe"=>$array_cinetpay[':cpm_phone_prefixe'],
	":cpm_error_message"=>$array_cinetpay[':cpm_error_message'],
	":cpm_payid"=>$array_cinetpay[':cpm_payid'],
	":cpm_ipaddr"=>$array_cinetpay[':cpm_ipaddr'], 
	":cpm_designation"=>$array_cinetpay[':cpm_designation']);
    
$sql = 'INSERT INTO retour_cinetpay(
		cpm_site_id,
		cpm_amount,
		cpm_trans_id,
		cpm_trans_date,
		cpm_page_action,
		cpm_payment_config,
		cpm_version,
		cpm_return_mode,
		cpm_result,
		cpm_trans_status,
		cpm_payment_date,
		cpm_payment_time,
		cpm_currency,
		cpm_language,
		cpm_custom,
		signature,
		payment_method,
		cel_phone_num,
		cpm_phone_prefixe,
		cpm_error_message,
		cpm_payid,
		cpm_ipaddr,
		cpm_designation
		 ) VALUES ( 
		:cpm_site_id,
		:cpm_amount,
		:cpm_trans_id,
		:cpm_trans_date,
		:cpm_page_action,
		:cpm_payment_config,
		:cpm_version,
		:cpm_return_mode,
		:cpm_result,
		:cpm_trans_status,
		:cpm_payment_date,
		:cpm_payment_time,
		:cpm_currency,
		:cpm_language,
		:cpm_custom,
		:signature,
		:payment_method,
		:cel_phone_num,
		:cpm_phone_prefixe,
		:cpm_error_message,
		:cpm_payid,
		:cpm_ipaddr,
		:cpm_designation)';

	$sql_rout= $conn_db->prepare($sql);
	$sql_rout->execute($array_cinetpay);
	$result_fecth=$sql_rout->fetch(); 
	$idlast_pay_cinetpay= $conn_db->lastInsertId(); 
    
    
	insert_session_notif($idlast_pay_cinetpay, $conn_db); 
   
    exit();
}; 











?>