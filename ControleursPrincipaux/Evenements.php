<?php

require_once('../controleur.php');

try{
	CtlAfficheEvenements();

}catch(Exception $e){
	$msg = $e->getMessage() ; 		
	CtlErreur($msg); 				
}
