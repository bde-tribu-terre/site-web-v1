<?php

require_once('../controleur.php');

try{
	CtlAfficheContact();
	
}catch(Exception $e){
	$msg = $e->getMessage() ; 		
	CtlErreur($msg); 		
}