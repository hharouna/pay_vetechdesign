<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>

<body>
<?php 
extract($_POST);

$csrf_token; //- retour code de sécurité 
$cpm_site_id; //identifiant site 
$cpm_amount;// montant payer 
$cpm_trans_id;// identifiant paiement 
$cpm_trans_date; // date de paiement 
$cpm_page_action; // action de paiment 
$cpm_payment_config; // valeur de SINGLE
$cpm_version ;// version des CNINETPAY va1
$cpm_return_mode ;// type envois paramettre  POST 
$cpm_result; // type d'Erreur de code envoyer 

$cpm_trans_status; // ACCEPTED OU NON 
$cpm_payment_date; // date de  paiment sous format Y-m-d
$cpm_payment_time ;//  date time sous format h:i:s 
$cpm_currency; // type de moyen d'echange 
$cpm_language;// language parler 
$cpm_custom ;// mail identifiant cinetpay 

$signature ;// singnature cinet pay
$payment_method; //  mode de paiement 

$cel_phone_num; // numero de paiement 
$cpm_phone_prefixe;// prefixe dur paiement 
$cpm_error_message;// type de message Error 
$cpm_payid ;// idendifiant confrimation de paiement 
$cpm_ipaddr; // facultatif  
echo $cpm_payid ; 
?>

erreur
</body>
</html>