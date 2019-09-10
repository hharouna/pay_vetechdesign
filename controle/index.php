<?php 
include_once("controle/indexinclude.php");
require_once("private/connect_db.php");
include_once("controle/function.php");

session_form();
extract($_POST);

                     $sqlform = 'SELECT * FROM listeformation ORDER BY formation ASC';
					 $form = $db->prepare($sqlform); 
					 $form->execute(); 
					 $resultform = $form->fetchAll(PDO::FETCH_ASSOC); 
					
					
			$listeformation='';  
			foreach($resultform as $formation => $liste){
			$listeformation.= 	'<option c="cad" value="'.$liste['idforma'].'" at="'.$liste['formation'].'">'.$liste['formation'].'</option>';
      		};



?>

<html><head>
<link rel="stylesheet" type="text/css" href="css/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/css/bootstrap.css">

<link href='css/build/style.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="css/afficherformation/style.css">

<title>FORMATION VETECH&amp;DESIGN</title>

</head>
<link rel="icon" type="image/png" id="favicon" href="imgformation/licone.png"/>
<link rel="stylesheet" type="text/css" href="css/afficherformation/style.css">
    <link rel="stylesheet" type="text/css" href="fonts/css/fontawesome.css">
<link rel="icon" type="image/png" id="favicon" href="imgformation/licone.png"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="css/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/js/bootstrap.js"></script>

<script src="fonts/js/all.js"></script>
<script type="text/javascript" src="js/formation.js"></script>
<script type="text/javascript" src="module/js/moduleindex.js"></script>





<script type="text/javascript">
 


var _smartsupp = _smartsupp || {};
_smartsupp.key = '41c7e0d7c8838ed9eac8cb0551fcbcc15b8f583e';
window.smartsupp||(function(d) {
var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
s=d.getElementsByTagName('script')[0];c=d.createElement('script');
c.type='text/javascript';c.charset='utf-8';c.async=true;
c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>

<body>



<div class="modal fade bs-example-modal-lg card " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>

<div class="shadow p-3 mb-5 bg-white rounded" style=" margin-left: auto; margin-right:auto; width:800px; height:auto; margin-top:10px; ">
<div class='' > <div class='session-formation-' > <div class='session-logovetech-' > <div class='logo-vetech'> </div> <div class="numero-vetech"> </div></div>
<div class='session-pub- card card-body' > </div>
<div class='session-selection card card-body' > <div class='comment-select' >Formation </div>
<div class='fleche-selection' > </div>
<div class='choix-selection-' > <div class='selection-text' >
<select class="form-control" id="listeformation">
  <option c='n' value="" at="">---- Selectionnez votre formation ----</option>
 <?php echo $listeformation; ?>
</select>
</div></div>
<div class='btn-selection-text ' > </div></div></div>
<div class='Formulaire-renseignement  card card-body' > <div class='formulaire-id' >
<div class='formulaire-contenu card card-body' > <div class='titre-formulaire card-header' >REMPLISSEZ LE FORMULAIRE </div>
<div class='formation-selectionnez' > <div class='libelle-formation-' >Formation </div>
<div class='choix-formation' > <div class='fleche-selection' > </div>
<div class='choix-format' > </div></div></div>
<div class='liste-input' >
<div class="" style="margin-left:auto; margin-right:auto; width:502px; " >
<input type="hidden" class="form-control choixform custom-select mr-sm-2" value="" placeholder="Votre activitée" />
 <div class='form-input' > <input type="text" class="form-control nomform" value="" placeholder="Nom" /> </div>
<div class='form-input' > <input type="text" class="form-control prenomform" value="" placeholder="Prenom(s)" /></div>
<div class='form-input' > <input type="text" class="form-control contact" value="" placeholder="Contact" /></div>
<div class='form-input' > <input type="text" class="form-control adressemailform" value="" placeholder="E-mail : exemple@vetechdesign.net" /></div>
<div class='form-input' > <input type="text" class="form-control fonctionform " value="" placeholder="Fonction" /></div>
<div class='form-input' ><input type="text" class="form-control activeform" value="" placeholder="Votre activitée" /></div></div>


<div class='listeformation'></div>
<div class="erreur-input"></div>
<div class='form-input img' > </div>
<div class='form-input' >
 <button class="btn btn-default form-control btn-sm disabled btn-confrim-add"  > Confirmation </button> </div>


</div><div class="imageselect"  style=" margin-right:auto; margin-left:auto; width:350px; height:130px;  "> </div></div>
 </div></div>
<div class='pied-page color-swatches card  card-footer border border-dark' > <div class='contenu-pied-page' style="padding:10px; "  > <div class="color-swatch gray-light">


<?php echo pied($db_admin) ; $f_date = date("Y");  echo "<hr> vetechdesign.net © 2018 -".$f_date?>

 </div></div></div></div></div></div></div></body></html>