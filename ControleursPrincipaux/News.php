<?php

require_once('../controleur.php');

try{
	CtlAfficheNews();

}catch(Exception $e){
	$msg=$e->getMessage();
	CtlErreur($msg);
}