<!DOCTYPE html>
<html>
	<head>
		<title>Tribu-Terre</title>
		<meta charsert='utf-8'>
		<link rel="stylesheet" href="../style.css">
		
	</head>
	<body>
		<nav>
			<header>
				<p>
					<img src="../images/Tribu-terre-logo.png" class="Tt" />
					<img src="../images/reseaux.png" alt="" usemap="map-reseaux" class="reseaux"/>
						<h1>Tribu-Terrement vôtre</h1>
				</p>
				<map name="map-reseaux">
					<area shape="rect" coords="10,10,100,100"
						href="facebook.com" alt="exemple de cercle" />

					<area shape="rect" coords="10, 5, 20, 15"
						href="Instagram.com" alt="exemple de rectangle" />

					<area shape="rect" coords="10, 5, 20, 15"
						href="Twitter.com" alt="exemple de rectangle" />
				</map>
			</header>
			<!--	<div class="box-gauche">
					<p>
						Accès rapides aux différentes parties du site :<br/>
					
						<ul>
							<li><a href="News.php"><b><u>News :</u></b></a><br/>
									<a href="News/#">	Derniere news 1</a><br/>
									<a href="News/#">	Derniere news 2</a><br/>
									<a href="News/#">	Derniere news 3</a>
							</li>
							<li><a href="Evenements.php"><b><u>Evenements :</u></b></a>
									<a href="Evenements/#">	Dernier evenement 1</a>
									<a href="Evenements/#">	Dernier evenement 2</a>
									<a href="Evenements/#">	Dernier evenement 3</a>
							</li>
							<li><a href="Photos/#"><b><u>Dernieres photos</u></b></a></li>
							<a href="NousContacter.php"><li><b><u>Nous contacter</u></b></li></a>
						</ul>
						<br/><br/>
					</p>
				</div>
				<div class="box-droite">
					<p>
						<a href="Photos/#"><center>Dernieres photos :</center></a>
						<?php echo affichePhotos() ?>
					</p>			
				</div> -->
				<div class="box-principale">
					<div class="menu">
						<ul>
							<li><a href="Editer.php">Editer</a></li>
							<li><a href="poles.php">Pôles</a> </li>
							<li><a href="Présentation.php">Presentation</a></li>
							<li><a href="News.php">News</a></li>
							<li><a href="Evenements.php">Evenements</a></li>
						</ul>
					</div>
						<p>
							<?php if(isset($contenu)){echo $contenu;} ?>
						</p>
						<div class="articles">
							<?php if(isset($articles)){echo $articles;} ?>
						</div>
				</div>
		</nav>

		<footer>
			<p>Vous avez des questions sur Tribu-Terre ou les derniers évènements ?<br/>Contactez nous ! <a href="NousContacter.php">Nous contacter</a></p>
		</footer>

	</body>
</html>