<?php

 require_once("src/CinetPay/CinetPay.php");

 
 /*
 $session_montant ; 
 $id_session_formation;
 $id_formation; 
 $description_projet
 
 */
 
 

//use CinetPay\CinetPay;
/*
 * Preparation des elements constituant le panier
 */
$apiKey = "8558440625d122cc3e5dd79.23396372"; // Remplacez ce champs par votre APIKEY
$site_id = "380645"; // Remplacez ce champs par votre SiteID
$id_transaction = CinetPay::generateTransId(); // Identifiant du Paiement
$description_du_paiement = sprintf($description_projet, $id_transaction); // Description du Payment
$date_transaction = date("Y-m-d H:i:s"); // Date Paiement dans votre système
$montant_a_payer = mt_rand(100, 200); // Montant à Payer : minimun est de 100 francs sur CinetPay
$identifiant_du_payeur = 'pay@vetechdesign.net'; // Mettez ici une information qui vous permettra d'identifier de façon unique le payeur
$formName = "vetechdesign"; // nom du formulaire CinetPay
$notify_url = 'https://pay.vetechdesign.net/notif.php'; // Lien de notification CallBack CinetPay (IPN Link)
$return_url = 'https://pay.vetechdesign.net/return.php'; // Lien de retour CallBack CinetPay
$cancel_url = 'https://pay.vetechdesign.net/erreur.php'; // Lien d'annulation CinetPay
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