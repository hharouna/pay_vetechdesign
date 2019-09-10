


<?php 
include_once('private/indexinclude.php'); 
require_once('private/connect_db.php'); 
require_once("src/CinetPay/CinetPay.php");

session_pay();// session pay 
	if(empty($_SESSION['ID_FORMATION'])) : header("location: https:www.vetechdesign.net") ; endif ; 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pay Vetechdeisgn </title>
<link rel="icon" type="image/png" id="favicon" href="imgpay/licone.png"/>
<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.css"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script>
function myFunction() {
	var str = $( "form" ).serialize()
  setTimeout(function(){ 
   
     var txt = $("input").val();
  $.post("https://secure.cinetpay.com", str , function(result){
   window.location.replace('https://secure.cinetpay.com')
  });
   
   
   
    /*
  $.post(
   "https://secure.cinetpay.com", 
  {url: location.replace,
     data: (str) } 
    
      );
  $(element).text() renvoi la valeur du texte qui une fois récupéré
         dans mon index.php devrait remplir les conditions de mon switch
	$.post( "https://secure.cinetpay.com", $( "form" ).serialize());*/   
  
   }, 3000);
}

myFunction() 
</script>


</head>

<body>

<div class="card" style="height:auto; width:600px; margin-left:auto; margin-right:auto; margin-top:50px;">
  <div class="card-header">
   <img src="img/vetechdesign.png" width="269" height="75" />
  </div>
<div class="card-body">
<h5 class="card-title">Paiement Vetech&Design </h5>
<p class="card-text"><?php echo 	"<h3>".strtoupper($_SESSION['NOM']).' '.ucwords(strtolower($_SESSION['PRENOM']))."</h3>";?></p>
<p class="card-text alert alert-warning"><h5 class="text text-primary">Nous vous invitons à suivre les instructions</h5></p>
<table class="table table-hover">
<tr>  <td colspan="4" class="text text-center"> Information sur la session de formation </td></tr>
<tr> <td>Formation: </td><td ><div class="text text-info"><?php echo $_SESSION["TITRE_FORMATION"];?></div> </td><td>Chapitre:  </td><td  ><div class="text text-info"><?php echo $_SESSION["TITRE_MODULE"];?> </div></td></tr>
<tr> <td> Date session: </td><td><div class="text text-info"> <?php echo $_SESSION["DATE_SESSION"] ; ?></div></td>
<td>Durée: </td><td><div class="text text-info"><?php echo $_SESSION["DUREE"].' h -> '.$_SESSION["H_SESSION"].' : '.$_SESSION["M_SESSION"];?></div> </td></tr>
<tr> <td colspan="2">Montant session: </td><td colspan="2"><div class="text text-danger"><?php echo number_format($_SESSION["F_MONTANT"],0,',',' ').' Francs CFA ' ;?></div> </td></tr>

</tr><td colspan="4"> 

<?php

 
 /*
 $session_montant ; 
 $id_session_formation;
 $id_formation; 
 $description_projet
 
 */
 
 /*
 ID_SESSION"=>$id_session, 
												"F_MONTANT"=>$f_montant, 
												"ID_FORMATION"=>$id_etudiant,
												"ID_CHAPTRE"=>$id_chapitre,
												"ID_FORMA"=>$id_forma,
												"ID_PAY_VETECH"=>$id_code_paiement*/
	
	

//use CinetPay\CinetPay;
/*
 * Preparation des elements constituant le panier
 */
$apiKey = "8558440625d122cc3e5dd79.23396372"; // Remplacez ce champs par votre APIKEY
$site_id = "380645"; // Remplacez ce champs par votre SiteID
$id_transaction = CinetPay::generateTransId(); // Identifiant du Paiement
$description_du_paiement = sprintf($_SESSION["ID_FORMATION"].'-'.$_SESSION["ID_FORMA"].'-'.$_SESSION["ID_SESSION"], $id_transaction); // Description du Payment
$date_transaction = date("Y-m-d H:i:s"); // Date Paiement dans votre système
$montant_a_payer = $_SESSION["F_MONTANT"]; // Montant à Payer : minimun est de 100 francs sur CinetPay

$identifiant_du_payeur =$_SESSION["ID_FORMA"].'-'.$_SESSION["ID_CHAPTRE"].'-'.$_SESSION["ID_SESSION"].'-'.
$_SESSION["ID_FORMATION"].'-'.$_SESSION["MAIL"].'-'.$_SESSION["NOM"].'-'.$_SESSION["PRENOM"]; // Mettez ici une information qui vous permettra d'identifier de façon unique le payeur
$formName = "vetechdesign"; // nom du formulaire CinetPay
$nomsession=$_SESSION['NOM'];
$prenomsession= $_SESSION['PRENOM'];
$notify_url = 'https://pay.vetechdesign.net/controle/notif.php'; // Lien de notification CallBack CinetPay (IPN Link)
$return_url = 'https://pay.vetechdesign.net/controle/return.php'; // Lien de retour CallBack CinetPay
$cancel_url = 'https://pay.vetechdesign.net/controle/cancel.php'; // Lien d'annulation CinetPay


// Configuration du bouton
$btnType = 2;//1-5xwxxw
$btnSize = 'large'; // 'small' pour reduire la taille du bouton, 'large' pour une taille moyenne ou 'larger' pour  une taille plus grande

// Paramétrage du panier CinetPay et affichage du formulaire
$cp = new CinetPay($site_id, $apiKey);
try {
    $cp->setTransId($id_transaction)
        ->setDesignation($description_du_paiement)
        ->setTransDate($date_transaction)
        ->setAmount($montant_a_payer)
        ->setDebug(false)// Valorisé à true, si vous voulez activer le mode debug sur cinetpay afin d'afficher toutes les variables envoyées chez CinetPay
        ->setCustom($identifiant_du_payeur)// optional
        ->setNotifyUrl($notify_url)// optional
        ->setReturnUrl($return_url)// optional
        ->setCancelUrl($cancel_url)// optional
        ->displayPayButton($formName, $btnType, $btnSize);
} catch (\Exception $e) {
    print $e->getMessage();
}
?>

<?php
//```
## Script de notification (IPN Script)

//```php
//use CinetPay\CinetPay;

$id_transaction = $_POST['cpm_trans_id'];
if (!empty($id_transaction)) {
    try {
        $apiKey = "8558440625d122cc3e5dd79.23396372"; //Veuillez entrer votre apiKey
        $site_id = "380645"; //Veuillez entrer votre siteId

        $cp = new CinetPay($site_id, $apiKey);

        // Reprise exacte des bonnes données chez CinetPay
        $cp->setTransId($id_transaction)->getPayStatus();
        $paymentData = [
            "cpm_site_id" => $cp->_cpm_site_id,
            "signature" => $cp->_signature,
            "cpm_amount" => $cp->_cpm_amount,
            "cpm_trans_id" => $cp->_cpm_trans_id,
            "cpm_custom" => $cp->_cpm_custom,
            "cpm_currency" => $cp->_cpm_currency,
            "cpm_payid" => $cp->_cpm_payid,
            "cpm_payment_date" => $cp->_cpm_payment_date,
            "cpm_payment_time" => $cp->_cpm_payment_time,
            "cpm_error_message" => $cp->_cpm_error_message,
            "payment_method" => $cp->_payment_method,
            "cpm_phone_prefixe" => $cp->_cpm_phone_prefixe,
            "cel_phone_num" => $cp->_cel_phone_num,
            "cpm_ipn_ack" => $cp->_cpm_ipn_ack,
            "created_at" => $cp->_created_at,
            "updated_at" => $cp->_updated_at,
            "cpm_result" => $cp->_cpm_result,
            "cpm_trans_status" => $cp->_cpm_trans_status,
            "cpm_designation" => $cp->_cpm_designation,
            "buyer_name" => $cp->_buyer_name,
        ];
        // Recuperation de la ligne de la transaction dans votre base de données

        // Verification de l'etat du traitement de la commande

        // Si le paiement est bon alors ne traitez plus cette transaction : die();

        // On verifie que le montant payé chez CinetPay correspond à notre montant en base de données pour cette transaction

        // On verifie que le paiement est valide
        if ($cp->isValidPayment()) {
            echo 'Felicitation, votre paiement a été effectué avec succès';
            die();
        } else {
            echo 'Echec, votre paiement a échoué pour cause : ' . $cp->_cpm_error_message;
            die();
        }
    } catch (Exception $e) {
        // Une erreur s'est produite
        echo "Erreur :" . $e->getMessage();
    }
} else {
    // redirection vers la page d'accueil
    die();
}


## ```Votre Api Key et Site ID

//Ces informations sont disponibles dans votre BackOffice CinetPay.

## Aller en profondeur
?>
</td>
</tr>
</table>
 <div class="text text-info"> vetechdesign.net © 2018 - <?php $f_date = date('Y');  echo $f_date ; ?> </div>
</div>

</div>
</body>
</html>
