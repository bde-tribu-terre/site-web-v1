<?php

require_once('modele.php');
require_once("vue.php");

function CtlAfficheEditer(){
	afficheEditer();
}

function CtlConfirmer($page,$titre,$texte){
	ajouterArticle($page,$titre,$texte);
	afficheConfirmer();
}

function CtlAffichePresentation(){
	affichePresentation();
}

function CtlAfficheNews(){
	$articles = getArticles('News');
	afficheNews($articles);
}

function CtlAfficheEvenements(){
	$articles = getArticles('Evenements');
	afficheEvenements($articles);
}

function CtlAfficheCommentaire(){
	afficheCommentaire();
}

function CtlAfficheContact(){
	afficheContact();
}

function CtlErreur($erreur){
	afficherErreur($erreur) ;
}