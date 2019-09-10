<?php 

//$add_session_pay[0],$id_session_pay,$id_cinetpay_retour, $pay_db_session


function pied($db_pied){
	
	       

			$sql_select_pied= '
			SELECT 
			*
			FROM
			piedpage
			';
	
			$sql_pied= $db_pied->prepare($sql_select_pied); 
			$sql_pied->execute(); 
			$count_pied=  $sql_pied->rowCount();
			$rest_fetch_pied= $sql_pied->fetch(); 
			
			return $rest_fetch_pied['textpied'];
	
	}

function recu_pay($id_formation, $id_sess_pay, $_cinet_pay_retour, $db_recu){

			$sql_retour_pay = '
			SELECT 
			formation.nomform as nom, 
			formation.prenomform as prenom, 
			formation.adressemailform as mail, 
			formation.contact as f_contact,
			retour_cinetpay.cpm_amount as montant,
			retour_cinetpay.cpm_currency as xof,
			retour_cinetpay.date_cmp_cinetpay as date,
			retour_cinetpay.cel_phone_num as numero,
			retour_cinetpay.cpm_payid as id_pay_reseau,
			retour_cinetpay.payment_method as reseau,
			listeformation.formation as form, 
			moduleform.titrechapitre as chapitre,
			sessionform.heure_duree as n_heure ,
			sessionform.date_session as n_date ,
			sessionform.heure_session as n_h ,
			sessionform.minute_session as n_m
			
			FROM
			pay_session,
			retour_cinetpay,
			formation, 
			listeformation,
			moduleform,
			sessionform
	
			WHERE
			pay_session.id_cinetpay_retour =?
			AND 
			retour_cinetpay.id_retour_cinetpay = pay_session.id_cinetpay_retour 
			AND 
			formation.idformation = pay_session.id_etudiant_session_pay
			AND 
			listeformation.idforma = pay_session.id_session_form_pay
			AND 
			moduleform.idmodule = pay_session.id_form_idforma
            AND 
			sessionform.idsessionform = pay_session.id_module_sesspay
			';
			
			$sql_recu= $db_recu->prepare($sql_retour_pay); 
			$sql_recu->execute(array($_cinet_pay_retour)); 
			$count_recu=  $sql_recu->rowCount();
			$rest_fetch_recu = $sql_recu->fetch(); 
			
			if($rest_fetch_recu['reseau']=="OM"): 
			$reseau ="ORANGE"; 
			elseif($rest_fetch_recu['reseau']=="MOMO"): 
			$reseau ="MTN"; 
			elseif($rest_fetch_recu['reseau']=="FLOOZ"): 
			$reseau ="MOOV"; 
			elseif($rest_fetch_recu['reseau']=="ECOVISA"): 
			$reseau ="CARD BANCAIRE"; 
			else:
			$reseau ="------";
			endif;
			$f_date = date("Y"); 
			
	 
	       
			$recu_pay ='<div class="card card-body" style=" width:600px;  padding:10px;  margin-top:50px; margin-right:auto; margin-left:auto; height:auto; "> '; 
		    $recu_pay.='<div class="card-header"><img src="../img/vetechdesign.png" width="296" height="75" /></div>';
  $recu_pay.='<div class="text text-center"><h3> Facture</h3>  </div>';
			$recu_pay.='<div class="">Réseau : <span> '.$reseau.' </span> --> REF PAIEMENT : <span class="text text-danger"> '.$rest_fetch_recu['id_pay_reseau']. ' </span>  --> Numero : <span class="text text-danger"> '.$rest_fetch_recu['numero']. ' </span></div> <hr>';
			$recu_pay.='<div><div class=""> Nom :  <span class="text text-info"> '.$rest_fetch_recu['nom'].'</span> |  Prenom (s) : <span class="text text-info"> '.$rest_fetch_recu['prenom'].' </span> | Numéro :<span class="text text-info"> '.$rest_fetch_recu['f_contact'].' </span> </div></div>';
			$recu_pay.='<div><div class="">Module Formation :<span class="text text-info"> '.$rest_fetch_recu['form'].'</span> </br> Chapitre :<span class="text text-info"> '.$rest_fetch_recu['chapitre'].' </span></div></div> <hr>';
			$recu_pay.='<div><div class=""> Session de formation : <span class="text text-info">'.$rest_fetch_recu['n_date'].' a '.$rest_fetch_recu['n_h'].' : '.$rest_fetch_recu['n_m'].' </span> | Nombre d'."'heure :<span class='text text-info'>  ".$rest_fetch_recu['n_heure'].' H </span>  </div></div> <hr>';
	
			
			$recu_pay.='<div><div class="">Montant : <span class="text text-info"> '.number_format($rest_fetch_recu['montant'],0,',',' ').' '.$rest_fetch_recu['xof'].' T.T.C';
			$recu_pay.=' </span> | Date paiement:<span class="text text-info"> '.$rest_fetch_recu['date'].' </span></div></div>';
			
			$recu_pay.=' <hr><div class="text text-info  text-left" > vetechdesign.net © 2018 -'.$f_date.' <button class="btn btn-default btn-sm text " ><li class="fa fa-print "> </li></button></div>';
			
			
			/*   contenu mail recu  */
			
$recu_mail ='<div class="card card-body" style=" width:600px;  padding:10px;  margin-top:50px; margin-right:auto; margin-left:auto; height:auto; "> '; 
$recu_mail.='<div class="card-header"><img src="pay.vetechdesign.net/img/vetechdesign.png" width="296" height="75" /></div>';
$recu_mail.='<div class="text text-center"><h3> Facture</h3>  </div>';
$recu_mail.='<div class="">Réseau : <span> '.$reseau.' </span> --> REF PAIEMENT : <span class="text text-danger"> '.$rest_fetch_recu['id_pay_reseau']. ' </span> -->Numero : <span class="text text-danger"> '.$rest_fetch_recu['numero']. ' </span></div> <hr>';
$recu_mail.='<div><div class=""> Nom :  <span class="text text-info"> '.$rest_fetch_recu['nom'].'</span> |  Prenom (s) : <span class="text text-info"> '.$rest_fetch_recu['prenom'].' </span> | Numéro :<span class="text text-info"> '.$rest_fetch_recu['f_contact'].' </span> </div></div>';
$recu_mail.='<div><div class="">Module Formation :<span class="text text-info"> '.$rest_fetch_recu['form'].'</span> </br> Chapitre :<span class="text text-info"> '.$rest_fetch_recu['chapitre'].' </span></div></div> <hr>';
$recu_mail.='<div><div class=""> Session de formation : <span class="text text-info">'.$rest_fetch_recu['n_date'].' a '.$rest_fetch_recu['n_h'].' : '.$rest_fetch_recu['n_m'].' </span> | Nombre d'."'heure :<span class='text text-info'>  ".$rest_fetch_recu['n_heure'].' H </span>  </div></div> <hr>';

$recu_mail.='<div><div class="">Montant : <span class="text text-info"> '.number_format($rest_fetch_recu['montant'],0,',',' ').' '.$rest_fetch_recu['xof'];
$recu_mail.=' </span> | Date paiement:<span class="text text-info"> '.$rest_fetch_recu['date'].' </span></div></div>';

$recu_mail.=' <hr>
<div class="text text-info  text-left" > vetechdesign.net © 2018 -'.$f_date.' <button class="btn btn-default btn-sm text " ><li class="fa fa-print "> </li></button></div>';
			
			$contenu_recu='<div class="card-header"  style=" width:400px; height:auto; padding:10px;  margin-top:50px; margin-right:auto; margin-left:auto; >

<div class="text text-center">
<h3 style="text-align:center"><strong>Facture</strong></h3>
</div>

<div>R&eacute;seau :<span style="color:#e74c3c ; " > '.$reseau.' </span> --&gt; REF PAIEMENT : <span style="color:#e74c3c"> '.$rest_fetch_recu['id_pay_reseau']. '</span> </div>

<hr />

<div><strong>Nom : </strong><span style="color:#3498db">'.$rest_fetch_recu['nom'].' </span>| <strong>Prenom (s) :</strong><span style="color:#3498db"> '.$rest_fetch_recu['prenom'].'  </span>| <strong>Num&eacute;ro :<span style="color:#3498db"> </span></strong><span style="color:#3498db">'.$rest_fetch_recu['numero'].'</span></div>



<div><strong>Module Formation :</strong> <span style="color:#3498db">'.$rest_fetch_recu['form'].'</span><br />
<strong>Chapitre :</strong> <span style="color:#3498db">'.$rest_fetch_recu['chapitre'].' </span></div>


<hr />

<div><strong>Session de formation :</strong> <span style="color:#3498db">'.$rest_fetch_recu['n_date'].'</span> a <span style="color:#3498db">'.$rest_fetch_recu['n_h'].' : '.$rest_fetch_recu['n_m'].' </span> |<strong> Nombre d&#39;heure : </strong><span style="color:#3498db">04 H</span></div>


<hr />

<div><strong>Montant :</strong> <span style="color:#3498db">'.number_format($rest_fetch_recu['montant'],0,',',' ').' '.$rest_fetch_recu['xof'].'</span> | <strong>Date paiement:</strong> <span style="color:#3498db">'.$rest_fetch_recu['date'].'</span></div>
</div>

</div>';
	            $A = $rest_fetch_recu["mail"];
				$from = "pay@vetechdesign.net"; 
				$sujet = 'Facture session formation : '.$rest_fetch_recu['form']. ' Chapitre : '.$rest_fetch_recu['chapitre']; 
				$ptitle_recu = "FORMATION"; 
				$comment_recu_pay ="<center><h4 >Confrimation de votre d'inscription</h4> </center>";
	            cssmail($contenu_recu,$rest_fetch_recu["mail"],$from,$sujet,$ptitle_recu, $comment_recu_pay,$db_recu);
			    $recu_pay.='</div>';
			  
			  echo $recu_pay; 
					
			
			}

function recu_pay_notif($id_formation, $id_sess_pay, $_cinet_pay_retour, $db_recu){

    
    
			/*$sql_retour_pay = '
			SELECT 
			formation.nomform as nom, 
			formation.prenomform as prenom, 
			formation.adressemailform as mail, 
			formation.contact as f_contact,
			retour_cinetpay.cpm_amount as montant,
			retour_cinetpay.cpm_currency as xof,
			retour_cinetpay.date_cmp_cinetpay as f_date,
			retour_cinetpay.cel_phone_num as numero,
			retour_cinetpay.cpm_payid as id_pay_reseau,
			retour_cinetpay.payment_method as reseau,
			listeformation.formation as form, 
			moduleform.titrechapitre as chapitre,
			sessionform.heure_duree as n_heure ,
			sessionform.date_session as n_date ,
			sessionform.heure_session as n_h ,
			sessionform.minute_session as n_m
			FROM
			pay_session,
			retour_cinetpay,
			formation, 
			listeformation,
			moduleform,
            selectforma,
			sessionform
	
			WHERE
			pay_session.id_session_pay =?
			AND 
			retour_cinetpay.id_retour_cinetpay = pay_session.id_cinetpay_retour 
			AND 
			formation.idformation = pay_session.id_etudiant_session_pay
			AND 
			listeformation.idforma = pay_session.id_session_form_pay
			AND 
			moduleform.idmodule = pay_session.id_form_idforma
            AND 
			selectforma.idselectform = pay_session.id_module_sesspay
            AND 
            selectforma.id_session_form = session_form.idsessionfrom 
			';
			*/
    $sql_retour_pay = '
			SELECT 
			pay_session.id_session_pay as id_pay ,
            retour_cinetpay.id_retour_cinetpay as id_retour,
            formation.idformation	as id_etudiant,
            listeformation.idforma	as id_formation, 
            moduleform.idmodule as id_module , 
            selectforma.idselectform as id_select, 
            formation.nomform as nom, 
			formation.prenomform as prenom, 
			formation.adressemailform as mail, 
			formation.contact as f_contact,
			retour_cinetpay.cpm_amount as montant,
			retour_cinetpay.cpm_currency as xof,
			retour_cinetpay.date_cmp_cinetpay as f_date,
			retour_cinetpay.cel_phone_num as numero,
			retour_cinetpay.cpm_payid as id_pay_reseau,
			retour_cinetpay.payment_method as reseau,
			listeformation.formation as form, 
			moduleform.titrechapitre as chapitre,
			sessionform.heure_duree as n_heure ,
			sessionform.date_session as n_date ,
			sessionform.heure_session as n_h ,
			sessionform.minute_session as n_m
			FROM
			pay_session, 
            retour_cinetpay, 
            formation, 
            listeformation, 
            moduleform, 
            selectforma, 
            sessionform
			
			WHERE
			pay_session.id_session_pay =?
			AND 
            pay_session.id_cinetpay_retour =retour_cinetpay.id_retour_cinetpay
            AND 
            pay_session.id_etudiant_session_pay = formation.idformation		
            AND 
            pay_session.id_session_form_pay = listeformation.idforma
            AND 
            pay_session.id_form_idforma = moduleform.idmodule
            AND 
            pay_session.id_module_sesspay = selectforma.idselectform
            AND 
            selectforma.id_session_form= sessionform.idsessionform';
    
        
			$sql_recu= $db_recu->prepare($sql_retour_pay); 
			$sql_recu->execute(array($id_sess_pay)); 
			$count_recu=  $sql_recu->rowCount();
			$rest_fetch_recu = $sql_recu->fetch(); 
			  
  
 
			if($rest_fetch_recu['reseau']=="OM"): 
			$reseau ="ORANGE"; 
			elseif($rest_fetch_recu['reseau']=="MOMO"): 
			$reseau ="MTN"; 
			elseif($rest_fetch_recu['reseau']=="FLOOZ"): 
			$reseau ="MOOV"; 
			elseif($rest_fetch_recu['reseau']=="ECOVISA"): 
			$reseau ="CARD BANCAIRE"; 
			else:
			$reseau ="------";
			endif;
			$f_date = date("Y"); 
			
			$recu_pay ='<div class="card card-body" style=" width:600px;  padding:10px;  margin-top:50px; margin-right:auto; margin-left:auto; height:auto; "> '; 
		    $recu_pay.='<div class="card-header"><img src="../img/vetechdesign.png" width="296" height="75" /></div>';
  $recu_pay.='<div class="text text-center"><h3> Facture</h3>  </div>';
			$recu_pay.='<div class="">Réseau : <span> '.$reseau.' </span> --> REF PAIEMENT : <span class="text text-danger"> '.$rest_fetch_recu['id_pay_reseau']. ' </span>  --> Numero : <span class="text text-danger"> '.$rest_fetch_recu['numero']. ' </span></div> <hr>';
			$recu_pay.='<div><div class=""> Nom :  <span class="text text-info"> '.$rest_fetch_recu['nom'].'</span> |  Prenom (s) : <span class="text text-info"> '.$rest_fetch_recu['prenom'].' </span> | Numéro :<span class="text text-info"> '.$rest_fetch_recu['f_contact'].' </span> </div></div>';
			$recu_pay.='<div><div class="">Module Formation :<span class="text text-info"> '.$rest_fetch_recu['form'].'</span> </br> Chapitre :<span class="text text-info"> '.$rest_fetch_recu['chapitre'].' </span></div></div> <hr>';
			$recu_pay.='<div><div class=""> Session de formation : <span class="text text-info">'.$rest_fetch_recu['n_date'].' a '.$rest_fetch_recu['n_h'].' : '.$rest_fetch_recu['n_m'].' </span> | Nombre d'."'heure :<span class='text text-info'>  ".$rest_fetch_recu['n_heure'].' H </span>  </div></div> <hr>';
	
			
			$recu_pay.='<div><div class="">Montant : <span class="text text-info"> '.number_format($rest_fetch_recu['montant'],0,',',' ').' '.$rest_fetch_recu['xof'];
			$recu_pay.=' </span> | Date paiement:<span class="text text-info"> '.$rest_fetch_recu['f_date'].' </span></div></div>';
			
			$recu_pay.=' <hr><div class="text text-info  text-left" > vetechdesign.net © 2018 -'.$f_date.' <button class="btn btn-default btn-sm text " ><li class="fa fa-print "> </li></button></div>';
			
			
			/*   contenu mail recu  */
			
$recu_mail ='<div class="card card-body" style=" width:600px;  padding:10px;  margin-top:50px; margin-right:auto; margin-left:auto; height:auto; "> '; 
$recu_mail.='<div class="card-header"><img src="pay.vetechdesign.net/img/vetechdesign.png" width="296" height="75" /></div>';
$recu_mail.='<div class="text text-center"><h3> Facture</h3>  </div>';
$recu_mail.='<div class="">Réseau : <span> '.$reseau.' </span> --> REF PAIEMENT : <span class="text text-danger"> '.$rest_fetch_recu['id_pay_reseau']. ' </span> -->Numero : <span class="text text-danger"> '.$rest_fetch_recu['numero']. ' </span></div> <hr>';
$recu_mail.='<div><div class=""> Nom :  <span class="text text-info"> '.$rest_fetch_recu['nom'].'</span> |  Prenom (s) : <span class="text text-info"> '.$rest_fetch_recu['prenom'].' </span> | Numéro :<span class="text text-info"> '.$rest_fetch_recu['f_contact'].' </span> </div></div>';
$recu_mail.='<div><div class="">Module Formation :<span class="text text-info"> '.$rest_fetch_recu['form'].'</span> </br> Chapitre :<span class="text text-info"> '.$rest_fetch_recu['chapitre'].' </span></div></div> <hr>';
$recu_mail.='<div><div class=""> Session de formation : <span class="text text-info">'.$rest_fetch_recu['n_date'].' a '.$rest_fetch_recu['n_h'].' : '.$rest_fetch_recu['n_m'].' </span> | Nombre d'."'heure :<span class='text text-info'>  ".$rest_fetch_recu['n_heure'].' H </span>  </div></div> <hr>';

$recu_mail.='<div><div class="">Montant : <span class="text text-info"> '.number_format($rest_fetch_recu['montant'],0,',',' ').' '.$rest_fetch_recu['xof'];
$recu_mail.=' </span> | Date paiement:<span class="text text-info"> '.$rest_fetch_recu['date'].' </span></div></div>';

$recu_mail.=' <hr>
<div class="text text-info  text-left" > vetechdesign.net © 2018 -'.$f_date.' <button class="btn btn-default btn-sm text " ><li class="fa fa-print "> </li></button></div>';
			
			$contenu_recu='<div class="card-header"  style=" width:400px; height:auto; padding:10px;  margin-top:50px; margin-right:auto; margin-left:auto; >

<div class="text text-center">
<h3 style="text-align:center"><strong>Facture</strong></h3>
</div>

<div>R&eacute;seau :<span style="color:#e74c3c ; " > '.$reseau.' </span> --&gt; REF PAIEMENT : <span style="color:#e74c3c"> '.$rest_fetch_recu['id_pay_reseau']. '</span> </div>

<hr />

<div><strong>Nom : </strong><span style="color:#3498db">'.$rest_fetch_recu['nom'].' </span>| <strong>Prenom (s) :</strong><span style="color:#3498db"> '.$rest_fetch_recu['prenom'].'  </span>| <strong>Num&eacute;ro :<span style="color:#3498db"> </span></strong><span style="color:#3498db">'.$rest_fetch_recu['numero'].'</span></div>



<div><strong>Module Formation :</strong> <span style="color:#3498db">'.$rest_fetch_recu['form'].'</span><br />
<strong>Chapitre :</strong> <span style="color:#3498db">'.$rest_fetch_recu['chapitre'].' </span></div>


<hr />

<div><strong>Session de formation :</strong> <span style="color:#3498db">'.$rest_fetch_recu['n_date'].'</span> a <span style="color:#3498db">'.$rest_fetch_recu['n_h'].' : '.$rest_fetch_recu['n_m'].' </span> |<strong> Nombre d&#39;heure : </strong><span style="color:#3498db">04 H</span></div>


<hr />

<div><strong>Montant :</strong> <span style="color:#3498db">'.number_format($rest_fetch_recu['montant'],0,',',' ').' '.$rest_fetch_recu['xof'].'</span> | <strong>Date paiement:</strong> <span style="color:#3498db">'.$rest_fetch_recu['date'].'</span></div>
</div>

</div>';
    
   
	            $A = $rest_fetch_recu["mail"];
				$from = "pay@vetechdesign.net"; 
				$sujet = 'Facture session formation : '.$rest_fetch_recu['form']. ' Chapitre : '.$rest_fetch_recu['chapitre']; 
				$ptitle_recu = "FORMATION"; 
				$comment_recu_pay ="<center><h4 >Confrimation de votre d'inscription</h4> </center>";
	            cssmail_notif($recu_pay,$rest_fetch_recu["mail"],$from,$sujet,$ptitle_recu, $comment_recu_pay);
			    $recu_pay.='</div>';
			  
			}


function cssmail($contenumail,$pmail,$pform,$psujet,$ptitle,$commentmail,$db_mail){
	
	
	
	/*
	$contenumail: contenu html tu mail
	$pmail: du desintaire 
	$pform: le mail qui envois
	$psujet: le sujet du mail 
	$title: title du documents
	$piedpage: contenu pied de page
	
	*/
	
	           $versionphp = phpversion();// version de php5.6 7.1
			
			
				$cssmail = $pmail;
				$frommail =  'VETECH&DESIGN<'.$pform.'>'; 
				$sujetmail = $psujet; 
				$message = "<html>	<head><title>".$ptitle."</title></head>";
				$message.= 	'<body style="background: #CCC;">';   
				$message.= 	'<div style="width:750px; height:auto;  margin-left:auto; margin-right:auto;"> ';   
				$message.= 	'<div style="width:750px; height:auto;  margin-left:auto; margin-right:auto;"> '; 
				$message.= '<div class="entete" style="width:750px; height:80; margin-left:auto; margin-right:auto; 
									border-bottom:#00F thin solid; margin-bottom: 10px;  background:#FFF;
									-webkit-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
									-moz-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1); box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);  "> 
									<div style="width:750px; height:80;"> <a href="https://vetechdesign.net" target="_blank"><div class="logo-vetech" style="width: 269px; height: 75px; s ; cursor:pointer; "> <img src="https://formation.vetechdesign.net/imgformation/vetechdesign.png" width="269" height="75" />
									</div></div></a></div>';
				$message.= '<!-- debu contenu  -->
<div class="contenupage" style="width:auto; min-width:400px; height:auto; min-height:400px; margin-left:auto; margin-right:auto; border-bottom:#00F thin solid; background:#FFF; -webkit-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
-moz-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);  ">'		;
                 $message.=$commentmail; 
                $message.= $contenumail;
				
				$message.=' </div><!-- fin contenu -->
<div  class="piedpage" style="width:750px; height:auto;  margin-left:auto; margin-right:auto; margin-top:10px; border-bottom:#00F thin solid;   background: #5F5F5F;  -webkit-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
-moz-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
box-shadow: 0px 0px 3px 3px rgba(10,15,107,1); "> ';


            $message.= '<p><strong>MENTIONS LEGALES: </strong>La soci&eacute;t&eacute; <span style="color:#3498db">VETECH&amp;DESIGN</span> en abr&eacute;g&eacute; <span style="color:#3498db">Vision Evolutive des TECHnologies et DESIGN </span>est situ&eacute;e en <strong>C&ocirc;te d&rsquo;Ivoire</strong> dans la capitale d&rsquo;Abidjan,quartier Marcory derri&egrave;re <strong>ORCA DECO</strong> cit&eacute; Hibiscus; sous le<strong> N&deg;RCCM :</strong><span style="color:#3498db"><strong> </strong>CI-ABJ-2018-B-31815</span>; sous le<strong> N&deg;CC : </strong><span style="color:#3498db">1864676 A;</span> sous le<strong> N&deg;CNPS :</strong><span style="color:#3498db"> 335634; BP 16 Abidjan 12; Fixe : 21 000 312. </span></p>'; 
					
			$message.="</div><!--fin pied de page -->	</div></div>	</body></html>";

			 $headers  = 'From: VETECH&DESIGN <'.$pform.'>'."\r\n";
			 $headers .= 'MIME-Version: 1.0'."\r\n";
			 $headers .= 'X-Mailer: PHP/'.$versionphp."\r\n";
			 $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
			 $headers .= 'X-Confirm-Reading-To: VETECH&DESIGN <'.$pform.'>'."\r\n";
			 $headers .= 'X-Priority: 3'."\r\n";
			 $headers .= 'Priority: urgent'."\r\n";
			 $arraymail = array($cssmail,$frommail,$message,$headers);
			 //$arraymail = array($mail,$frommail,$message,$headers); 
	          
						
	if(mail($cssmail,$sujetmail ,$message,$headers)){
				 echo "<div class='alert alert-success' style='width:600px;  padding:10px;  margin-top:50px; margin-right:auto; margin-left:auto; height:auto; ' ><center> Votre inscription à été validé avec succès, merci de consulter votre adresse-Email : ".$cssmail." !!! pour plus de détails.<hr>
				    	L'équipe vetech&design vous remercie pour votre confiance.  </center></div>";  
				}
	}

function cssmail_notif($contenumail,$pmail,$pform,$psujet,$ptitle,$commentmail){
	
	
	
	/*
	$contenumail: contenu html tu mail
	$pmail: du desintaire 
	$pform: le mail qui envois
	$psujet: le sujet du mail 
	$title: title du documents
	$piedpage: contenu pied de page
	
	*/
	   
   
	           $versionphp = phpversion();// version de php5.6 7.1
			
			
				$cssmail = $pmail;
				$frommail =  'VETECH&DESIGN<'.$pform.'>'; 
				$sujetmail = $psujet; 
				$message = "<html>	<head><title>".$ptitle."</title></head>";
				$message.= 	'<body style="background: #CCC;">';   
				$message.= 	'<div style="width:750px; height:auto;  margin-left:auto; margin-right:auto;"> ';   
				$message.= 	'<div style="width:750px; height:auto;  margin-left:auto; margin-right:auto;"> '; 
				$message.= '<div class="entete" style="width:750px; height:80; margin-left:auto; margin-right:auto; 
									border-bottom:#00F thin solid; margin-bottom: 10px;  background:#FFF;
									-webkit-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
									-moz-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1); box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);  "> 
									<div style="width:750px; height:80;"> <a href="https://vetechdesign.net" target="_blank"><div class="logo-vetech" style="width: 269px; height: 75px; s ; cursor:pointer; "> <img src="https://formation.vetechdesign.net/imgformation/vetechdesign.png" width="269" height="75" />
									</div></div></a></div>';
				$message.= '<!-- debu contenu  -->
<div class="contenupage" style="width:auto; min-width:400px; height:auto; min-height:400px; margin-left:auto; margin-right:auto; border-bottom:#00F thin solid; background:#FFF; -webkit-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
-moz-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);  ">'		;
                 $message.=$commentmail; 
                $message.= $contenumail;
				
				$message.=' </div><!-- fin contenu -->
<div  class="piedpage" style="width:750px; height:auto;  margin-left:auto; margin-right:auto; margin-top:10px; border-bottom:#00F thin solid;   background: #5F5F5F;  -webkit-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
-moz-box-shadow: 0px 0px 3px 3px rgba(10,15,107,1);
box-shadow: 0px 0px 3px 3px rgba(10,15,107,1); "> ';


            $message.= '<p><strong>MENTIONS LEGALES: </strong>La soci&eacute;t&eacute; <span style="color:#3498db">VETECH&amp;DESIGN</span> en abr&eacute;g&eacute; <span style="color:#3498db">Vision Evolutive des TECHnologies et DESIGN </span>est situ&eacute;e en <strong>C&ocirc;te d&rsquo;Ivoire</strong> dans la capitale d&rsquo;Abidjan,quartier Marcory derri&egrave;re <strong>ORCA DECO</strong> cit&eacute; Hibiscus; sous le<strong> N&deg;RCCM :</strong><span style="color:#3498db"><strong> </strong>CI-ABJ-2018-B-31815</span>; sous le<strong> N&deg;CC : </strong><span style="color:#3498db">1864676 A;</span> sous le<strong> N&deg;CNPS :</strong><span style="color:#3498db"> 335634; BP 16 Abidjan 12; Fixe : 21 000 312. </span></p>'; 
					
			$message.="</div><!--fin pied de page -->	</div></div>	</body></html>";

			 $headers  = 'From: VETECH&DESIGN <'.$pform.'>'."\r\n";
			 $headers .= 'MIME-Version: 1.0'."\r\n";
			 $headers .= 'X-Mailer: PHP/'.$versionphp."\r\n";
			 $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
			 $headers .= 'X-Confirm-Reading-To: VETECH&DESIGN <'.$pform.'>'."\r\n";
			 $headers .= 'X-Priority: 3'."\r\n";
			 $headers .= 'Priority: urgent'."\r\n";
			 $arraymail = array($cssmail,$frommail,$message,$headers);
			 //$arraymail = array($mail,$frommail,$message,$headers); 
	          if(mail($cssmail,$psujet ,$message,$headers)){
                  
                  echo "mail"; 
              }
		          
	  
	}




?>