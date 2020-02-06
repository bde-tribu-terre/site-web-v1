<?php

	require_once('../controleur.php');

	try{
		CtlAfficheEditer();
		if (isset($_POST['Valider'])){
			$page = $_POST['page'];
			$titre = $_POST['titre'];
			$texte = $_POST['textArticle']; 
			CtlConfirmer($page,$titre,$texte);
		}
	}

	catch(Exception $e){
		$msg=$e->getMessage();
		CtlErreur($msg);
	}