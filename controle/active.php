
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



session_pay(); 
recu_pay($_SESSION["ID_FORMATION"],$id_session_pay,$_SESSION["id_cinetpay_retour"], $db);



?>
 
</div>

</div>
</body>
</html>
