<?php

function afficheEditer(){
	$contenu = '<form method="post">
					<label>Titre :</label><br/><input type="text" name="titre" size="100" /><br/>
					<label>Ajouter des photos</label><br/>
					<label>Contenu de l\'article</label><br/><textarea name="textArticle" cols="100" rows="8"></textarea><br/>
					<label>Pour la page :</label>
					<select name="page">
						<option value="News">News</option>
						<option value="Evenements">Evenements</option>
					</select><br/>
					<input type="submit" value="Valider" name="Valider"/>
				</form>';
	require_once('cadre.php');
}

function afficheConfirmer(){
	$contenu='<script> 
				if(confirm(\'Etes vous sûr ?\'){
					CtlAfficheNews();
				}
			 </script>';
}

function affichePresentation(){
	$contenu='<p>
					<h2>Présentation</h2>
					<img src="../images/bureau.png"> <br/>
					Ici se trouveraient quelques informations sur l\'asso, ses activités, ses différents pôles et potentiellement quelques paragraphes complémentaires pour les nouveaux arrivant en science ou pour nos camarades potentiellement interessés pour rejoindre le bureau ! <br/><br/>
					ps : Cette page ne serait pas la page d\'accueil du site car la majorité des utilisateurs chercherons plutot les dernières news.<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</p>';
	require_once("cadre.php");
}

function afficheNews($articles){
	$contenu='<h2>News</h2>
					<p>
						ps : Cette page serait la page d\'accueil du site<br/><br/>
						Ici se trouveraient des articles clicables traitant des dernieres nouvelles de l\'asso !<br/>
						Ce qui pourait ressembler a ceci :<br/>
					</p>';
/*			<div class="articles-news">
				<ul>
					<li>
						<a href="News/#">
							<img src="../images/image-news.jpg">
							<h3>Article 1</h3>
							<p>
								Leger descriptif de l\'article ou debut de ce dernier
							</p>
						</a>
					</li>
					<li>
						<a href="News/#">
							<img src="../images/image-news.jpg">
							<h3>Article 2</h3>
							<p>
								Leger descriptif de l\'article ou debut de ce dernier
							</p>
						</a>
					</li>	
					<li>
						<a href="News/#">
							<img src="../images/image-news.jpg">
							<h3>Article 3</h3>
							<p>
								Leger descriptif de l\'article ou debut de ce dernier
							</p>
						</a>
					</li>
					<li>
						<a href="News/#">
							<img src="../images/image-news.jpg">
							<h3>Article 4</h3>
							<p>
								Leger descriptif de l\'article ou debut de ce dernier
							</p>
						</a>
					</li>
				</ul>
			</div>';*/


	require_once('cadre.php');
}

function afficheEvenements($articles){
	$contenu = '<p>
					Ici se trouverait un menu similaire a celui des News a quelques différences près puisqu\'il n\'y serait affiché que les evenements auquels les etudiants pouraient participer et que les articles seraient presentés d\'une couleur différente<br/>
					Cela donnerait donc : <br/>
				</p>';
				/*<div class="articles-evenements">
					<ul>
						<li>
							<a href="Evenements/#">
								<img src="../images/image-evenement.jpg">
								<h3>Article 1</h3>
								<p>
									Brin de texte explicatif sur l\'évènement en question
								</p>
							</a>
						</li>
						<li>
							<a href="Evenements/#">
								<img src="../images/image-evenement.jpg">
								<h3>Article 2</h3>
								<p>
									Brin de texte explicatif sur l\'évènement en question
								</p>
							</a>
						</li>
						<li>
							<a href="Evenements/#">
								<img src="../images/image-evenement.jpg">
								<h3>Article 3</h3>
								<p>
									Brin de texte explicatif sur l\'évènement en question
								</p>
							</a>
						</li>
						<li>
							<a href="Evenements/#">
								<img src="../images/image-evenement.jpg">
								<h3>Article 4</h3>
								<p>
									Brin de texte explicatif sur l\'évènement en question
								</p>
							</a>
						</li>
					</ul>
				</div>';*/
	require_once('cadre.php');
}



function afficheContact(){
	$contenu ='<div class="organigramme">
				<p>
					Ici, les visiteurs pourraient contacter les différents pôles de Tribu-Terre via une liste d\'adresses mails et des lien vers les réseaux(à venir)<br/>
					<img src="../images/communication.jpg"/>
					<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</p>
			</div>';
	require_once('cadre.php');
}


function affichePhotos(){
	$contenu = '<a href="Tribu-Terre">
					<img src="../images/Tribu-Terre.png" name="Tribu-Terre" width="50" height="50">
				</a>
				<a href="Tribu-Terre">
					<img src="../images/Tribu-Terre.png" name="Tribu-Terre" width="50" height="50">
				</a>
				<a href="Tribu-Terre">
					<img src="../images/Tribu-Terre.png" name="Tribu-Terre" width="50" height="50">
				</a>
				<a href="Tribu-Terre">
					<img src="../images/Tribu-Terre.png" name="Tribu-Terre" width="50" height="50">
				</a>
				<a href="Tribu-Terre">
					<img src="../images/Tribu-Terre.png" name="Tribu-Terre" width="50" height="50">
				</a>
				<a href="Tribu-Terre">
					<img src="../images/Tribu-Terre.png" name="Tribu-Terre" width="50" height="50">
				</a>
				<a href="Tribu-Terre">
					<img src="../images/Tribu-Terre.png" name="Tribu-Terre" width="50" height="50">
				</a>';
	return $contenu;
}

function afficherErreur($erreur){
	$contenu='<p>'.$erreur.'</p>';
	require_once('cadre.php');
} 