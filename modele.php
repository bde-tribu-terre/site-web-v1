<?php

	require_once('connect.php');

	function getConnect(){
		$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connexion->query('SET NAMES UTF8');
 		return $connexion;

	}

	function getArticles($page){
		$connexion = getConnect();
		$articles='<ul>';
		$requete = $connexion->query("SELECT titre,texte FROM article WHERE page = '$page' ORDER BY idArticle DESC LIMIT 10");
		$requete->setFetchMode(PDO::FETCH_OBJ); 
		while($res = $requete->fetch()){
			$articles .= '<li><a href="News/#">
							<h3>'.$res->titre.'</h3><br/>'.
							'<p>'.$res->texte.'</p>
						</a></li>';
		}
		$articles .= '</ul>';
		return $articles;
	}

	function ajouterArticle($page,$titre,$texte){
		$connexion = getConnect();
		$requete = $connexion->prepare('INSERT INTO article(page,titre,texte) VALUES(:page,:titre,:texte)');
		$requete->setFetchMode(PDO::FETCH_OBJ); 
		$requete->bindValue(':page', $page, PDO::PARAM_STR);
		$requete->bindValue(':titre', $titre, PDO::PARAM_STR);
		$requete->bindValue(':texte', $texte, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}