<?php
        
		
		
              /* 
				$_SESSION["EMAIL"]=$infodessinateur['email']; // adresse email en cours 
			   	$_SESSION['ID_DESSINATEUR'] = true; ///  Dessinateur en cours 
				$_SESSION['adresse_ip'] = $_SERVER['REMOTE_ADDR']; // Adresse Email en mail 
				$_SESSION['nagvigateur'] = $_SERVER['HTTP_USER_AGENT']; // le navigateur encours et la serie 
				$_SESSION['dernier_temps'] = time(); // temps d e connexion encours
			    $_SESSION['nom']      = $infodessinateur['nom']; // nom du connecer
				$_SESSION['prenom']   = $infodessinateur['prenom']; // prenom du connecer
				$_SESSION['pseudo']   = $infodessinateur['pseudo']; // pseudo du connecer
				$_SESSION['Typeinsc'] = $infodessinateur['Typeinsc']; // Typeinsc  si le profile à été valider ou non  du connecer
				$_SESSION['activated'] = $infodessinateur['activated']; // activation du compte si le profile à été valider ou non  du connecer
				$_SESSION['idincs']   = $infodessinateur['pseudo'].'-/'.$infodessinateur['idincs']; // composition du temps et de l'id du connecer
				$_SESSION['IDCOMPLET']   = $infodessinateur['idincs']; //  l'id du dessinateur 
	
			   
			    */
		
		
		
		
		// session general des dessinateurs compte 
       function session_pay() {
				
				//****** Vectech&Design*****////
				//******La configuration de la session de demarrage *******//
				// OUVERTURE DE LA SESSION 
				session_name('__vetech_pay');
				//session_start();// demarrage de la session start
				//session_regenerate_id(true); // changer la valeur de ID  DU COOKIE 
				// session_name('__vetech_membre'); // nom de la velur de la session  
				
				$J	        = date('d-m-Y');  //-- date actuelle de la machine 
				$Jstrtotime = strtotime($J); // valeur du jour actuel en seconde...
				$tempspremis  = (60*60*24) + $Jstrtotime; // durée de la session
				$valeur = session_id();
				$dossier   = "/" ;// dossier de stockage de la session
				$domain   = ".vetechdesign.net" ; // site correspondant a la session
				$https  = true; // sécurité de la session https 
				$httponly  = true;  // sécurisé le httponly cookie
				$nomsession ='__vetech_pay';
				session_set_cookie_params($tempspremis,$dossier,$domain,$https,$httponly);// parametre de sécurité de session 
				//session_start();
				if(session_id() == '') {
				session_start();
				}
				
				//setcookie($nomsession,$valeur,$tempspremis,$dossier,$domain,$https,$httponly);
				//setcookie("PHPSESSID", $_COOKIE["PHPSESSID"], $tempspremis,$dossier,$domain,$https,$httponly);
				//--------------------------------------------------NGBATH--------------------------------------------------// 
				
			}
			

	
			
		function fermerture_pay(){
		// FUNCTION FIN DE SESSION  DE DECONNEXION
		           
				session_name('__vetech_pay');
				session_unset($_SESSION);
				session_destroy();
				session_write_close();
				$J	        = date('d-m-Y');  //-- date actuelle de la machine 
              	$Jstrtotime = strtotime($J); // valeur du jour actuel en seconde...
		        $nomsession ='__vetech_pay';
				$tempspremis  = $Jstrtotime+(60*60*24) ;
				$dossier   = "/" ;
				$domain   = ".vetechdesign.net" ;
				$https  =  true; //isset($_SERVER['HTTPS'] );
				$httponly  = true; 
				//session_start();// demarrage de la session start
				 
				if(session_id() == '') {
						 session_start();
						}
						session_regenerate_id(true); // changer la valeur de ID  DU COOKIE
		        //$valeur = session_id();
				session_set_cookie_params($tempspremis,$dossier,$domain,$https,$httponly);// parametre de sécurité de session 
				//setcookie($nomsession,$valeur,$tempspremis,$dossier,$domain,$https,$httponly);
			    //setcookie("PHPSESSID", $_COOKIE["PHPSESSID"], $tempspremis,$dossier,$domain,$https,$httponly);
				
		// retour de la validation
		//--------------------------------------------------NGBATH--------------------------------------------------// 
			}	
			
				

				
?>



