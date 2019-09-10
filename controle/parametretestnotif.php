

<?php 

extract($_POST);
include_once("function.php");
include_once('../private/indexinclude.php'); 
require_once('../private/connect_db.php');

$parametre = 'apikey=8558440625d122cc3e5dd79.23396372&';
$parametre.= 'cpm_site_id=380645&';
$parametre.= 'cpm_trans_id=7243329660';

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.cinetpay.com/v1/?method=checkPayStatus");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS,$parametre);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$page = curl_exec($curl);

/* affiche le resultat de la function */
$b = curl_multi_getcontent($curl);
$_transaction = json_decode($page, true);
//var_dump($_transaction);
//echo $_transaction['transaction']['cpm_custom'].'/'.$_transaction['transaction']['cpm_result']."<br>-------------------------------------------------------------------------------------------------------";
/*
{
	"transaction":{
		"cpm_site_id":"380645",
		"signature":"cee85aa099056fc2d0bd15fcfdfda2d03fa2f6e47dec70af6f34b558b73908af3324",
		"cpm_amount":"100",
		"cpm_trans_date":"08072019210825",
		"cpm_trans_id":"5276105858",
		"cpm_custom":"pay@vetechdesign.net",
		"cpm_currency":"CFA",
		"cpm_payid":"MP190708.1912.A90096",
		"cpm_payment_date":"2019-07-08",
		"cpm_payment_time":"19:12:22",
		"cpm_error_message":"SUCCES",
		"payment_method":"OM",
		"cpm_phone_prefixe":"225",
		"cel_phone_num":"49989669",
		"cpm_ipn_ack":"Y",
		"created_at":"2019-07-08 19:12:22",
		"updated_at":"2019-07-08 19:12:33",
		"cpm_result":"00",
		"cpm_trans_status":"ACCEPTED",
		"cpm_designation":"20-57-30",
		"buyer_name":""
	}
}

*/


if(empty($_transaction['transaction']['cpm_version'])): $_transaction['transaction']['cpm_version']="V1"; endif; 
if(empty($_transaction['transaction']['cpm_page_action'])): $_transaction['transaction']['cpm_page_action']="PAYMENT"; endif;
if(empty($_transaction['transaction']['cpm_payment_config'])): $_transaction['transaction']['cpm_payment_config']="SINGLE"; endif; 
if(empty($_transaction['transaction']['cpm_return_mode'])): $_transaction['transaction']['cpm_return_mode']="POST"; endif; 
if(empty($_transaction['transaction']['cpm_language'])): $_transaction['transaction']['cpm_language']="fr"; endif; 

	$cinetpay_array =  
	array(
	":cpm_site_id"=>$_transaction['transaction']['cpm_site_id'],
	":cpm_amount"=>$_transaction['transaction']['cpm_amount'],
	":cpm_trans_id"=>$_transaction['transaction']['cpm_trans_id'],
	":cpm_trans_date"=>$_transaction['transaction']['cpm_trans_date'],
	":cpm_page_action"=>$_transaction['transaction']['cpm_page_action'],
	":cpm_payment_config"=>$_transaction['transaction']['cpm_payment_config'],
	":cpm_version"=>$_transaction['transaction']['cpm_version'],
	":cpm_return_mode"=>$_transaction['transaction']['cpm_return_mode'],
	":cpm_result"=>$_transaction['transaction']['cpm_result'],
	":cpm_trans_status"=>$_transaction['transaction']['cpm_trans_status'],
	":cpm_payment_date"=>$_transaction['transaction']['cpm_payment_date'],
	":cpm_payment_time"=>$_transaction['transaction']['cpm_payment_time'],
	":cpm_currency"=>$_transaction['transaction']['cpm_currency'],
	":cpm_language"=>$_transaction['transaction']['cpm_language'],
	":cpm_custom"=>$_transaction['transaction']['cpm_custom'],
	":signature"=>$_transaction['transaction']['signature'],
	":payment_method"=>$_transaction['transaction']['payment_method'],
	":cel_phone_num"=>$_transaction['transaction']['cel_phone_num'],
	":cpm_phone_prefixe"=>$_transaction['transaction']['cpm_phone_prefixe'],
	":cpm_error_message"=>$_transaction['transaction']['cpm_error_message'],
	":cpm_payid"=>$_transaction['transaction']['cpm_payid'],
	":cpm_ipaddr"=>$_transaction['transaction']['cpm_ipn_ack'], 
	":cpm_designation"=>$_transaction['transaction']['cpm_designation']);

    // var_dump($cinetpay_array);

            $add_session_pay = explode('-',$_transaction['transaction']['cpm_custom']);
            $add_session_pay[0];// ID_FORMA  LISTEFORMATION
            $add_session_pay[1];// ID_MODULE CHAPITRE
            $add_session_pay[2];// ID_SESSION SESSION FORMAION
            $add_session_pay[3];// ID_ETUDIANT ID CANDIDAT 
            $add_session_pay[4];// ID_MAIL ADRESS EMAIL DEMANDEUR DE FORMATION 
            $add_session_pay[5];// NOM 
            $add_session_pay[6];// PRENOM
$_message='<center> Echec de votre paiement merci !!!</centre> <hr>'.$add_session_pay[5].' / '.$add_session_pay[6].'
						            <div>Information sur la session de formation: </div>'; 
notification_cinetpay_notif($cinetpay_array,$db);
//notification_erro($_message,$add_session_pay);
/* */
curl_close($curl); 


?>
