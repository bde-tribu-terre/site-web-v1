<?php

require_once('../controleur.php');

try{
	CtlAffichePresentation();

}catch(Exception $e){
	$msg = $e->getMessage() ; 		
	CtlErreur($msg); 				
}