<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pay Vetechdeisgn </title>
<link rel="icon" type="image/png" id="favicon" href="../imgpay/licone.png"/>
<link rel="stylesheet" type="text/css" href="../bootstrap-4.3.1-dist/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="../fonts/fontawesome-free-5.9.0-web/css/all.css"/>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/bootstrap.js"></script>

<script type="text/javascript" src="../fonts/fontawesome-free-5.9.0-web/js/all.js"></script>
</head>

<body>


<?php 
extract($_POST);
include_once("function.php");
include_once('../private/indexinclude.php'); 
require_once('../private/connect_db.php'); 

//$nomform= preg_replace('#[^a-zA-Z]#i','',$nomform);
/*
$csrf_token="747278ab4735ea8407f708628a0171ae95818e52";
$cpm_site_id= "380645";
$cpm_amount= "35000";
$cpm_trans_id= "5276105858";
$cpm_trans_date="20190708210825";
$cpm_page_action="PAYMENT";
$cpm_payment_config="SINGLE";
$cpm_version= "V1";
$cpm_return_mode="POST";
$cpm_result="00";
$cpm_trans_status="ACCEPTED";
$cpm_payment_date="2019-07-08"; 
$cpm_payment_time="19:12:22"; 
$cpm_currency= "CFA";
$cpm_language= "fr";
$cpm_custom= "20-44-30-57-hharouna86@gmail.com-harouna-harouna"; 
$signature= "cee85aa099056fc2d0bd15fcfdfda2d03fa2f6e47dec70af6f34b558b73908af3324"; 
$payment_method="OM"; 
$cel_phone_num= "05530080"; 
$cpm_phone_prefixe= "225" ; 
$cpm_error_message="SUCCES";
$cpm_ipaddr= "MP190708.1912.A90096"; 


csrf_token	1bf0490d7956f56955d6152efe10d85162e1265f
cpm_site_id	380645
cpm_amount	100
cpm_trans_id	9244764799
cpm_trans_date	20190712122604
cpm_page_action	PAYMENT
cpm_payment_config	SINGLE
cpm_version	V1
cpm_return_mode	POST
cpm_result	00
cpm_trans_status	ACCEPTED
cpm_payment_date	2019-07-12
cpm_payment_time	10:27:01
cpm_currency	CFA
cpm_language	fr
cpm_custom	20-57-44-30-hharouna86@gmail.com-harouna-harouna
signature	8f6af810812f07c0f297bcf6223bb520ee40f6966ed6c19175e85a50d7a102fd3324
payment_method	OM
cel_phone_num	49989669
cpm_phone_prefixe	225
cpm_error_message	SUCCES
cpm_payid	MP190712.1027.B19650
cpm_ipaddr	*/

if(empty($cpm_ipaddr)):  $cpm_ipaddr="vide"; endif; 

	$cinetpay_array =  
	array(
	":csrf_token"=>$csrf_token,
	":cpm_site_id"=>$cpm_site_id,
	":cpm_amount"=>$cpm_amount,
	":cpm_trans_id"=>$cpm_trans_id,
	":cpm_trans_date"=>$cpm_trans_date,
	":cpm_page_action"=>$cpm_page_action,
	":cpm_payment_config"=>$cpm_payment_config,
	":cpm_version"=>$cpm_version,
	":cpm_return_mode"=>$cpm_return_mode,
	":cpm_result"=>$cpm_result,
	":cpm_trans_status"=>$cpm_trans_status,
	":cpm_payment_date"=>$cpm_payment_date,
	":cpm_payment_time"=>$cpm_payment_time,
	":cpm_currency"=>$cpm_currency,
	":cpm_language"=>$cpm_language,
	":cpm_custom"=>$cpm_custom,
	":signature"=>$signature,
	":payment_method"=>$payment_method,
	":cel_phone_num"=>$cel_phone_num,
	":cpm_phone_prefixe"=>$cpm_phone_prefixe,
	":cpm_error_message"=>$cpm_error_message,
	":cpm_payid"=>$cpm_payid,
	":cpm_ipaddr"=>$cpm_ipaddr
) ; 

//$cinetpay_encode = json_encode(); 
notification_cinetpay_session($cinetpay_array, $db);

//var_dump($cinetpay_array);


/*
array(23) { [":csrf_token"]=> string(40) "747278ab4735ea8407f708628a0171ae95818e52" [":cpm_site_id"]=> string(6) "380645" [":cpm_amount"]=> string(3) "100" [":cpm_trans_id"]=> string(10) "5276105858" [":cpm_trans_date"]=> string(14) "20190708210825" [":cpm_page_action"]=> string(7) "PAYMENT" [":cpm_payment_config"]=> string(6) "SINGLE" [":cpm_version"]=> string(2) "V1" [":cpm_return_mode"]=> string(4) "POST" [":cpm_result"]=> string(2) "00" [":cpm_trans_status"]=> string(8) "ACCEPTED" [":cpm_payment_date"]=> string(10) "2019-07-08" [":cpm_payment_time"]=> string(8) "19:12:22" [":cpm_currency"]=> string(3) "CFA" [":cpm_language"]=> string(2) "fr" [":cpm_custom "]=> string(20) "pay@vetechdesign.net" [":signature"]=> string(68) "cee85aa099056fc2d0bd15fcfdfda2d03fa2f6e47dec70af6f34b558b73908af3324" [":payment_method"]=> string(2) "OM" [":cel_phone_num"]=> string(8) "49989669" [":cpm_phone_prefixe"]=> string(3) "225" [":cpm_error_message"]=> string(6) "SUCCES" [":cpm_payid "]=> string(20) "MP190708.1912.A90096" [":cpm_ipaddr"]=> string(0) "" } 

*/

?>

 
</div>

</div>
</body>
</html>
