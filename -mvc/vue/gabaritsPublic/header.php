<div class="jumbotron">
    <div class="container text-center">
        <a href="<?php echo $prefixe ?>">
            <img src="<?php echo $prefixe . '-images/imgLogoMini.png' ?>" alt="Logo" height="300">
        </a>
        <p>Association des étudiants en Science de l'Université d'Orléans</p>
    </div>
</div>

<nav class="navbar navbar-expand-sm navbar-tribu-terre py-0">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationHeader"> <!-- C'est le petit bouton menu quand l'écran est trop petit -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="navbar-collapse collapse" id="navigationHeader"> <!-- Et ça c'est quand l'écran est assez grand -->
        <ul class="nav navbar-nav">
            <li class="nav-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritAccueil.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo $prefixe ?>">Accueil</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Présentation <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritPresentation.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/' ?>">Qui sommes-nous ?</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritPourquoiAdherer.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/pourquoi-adherer/' ?>">Pourquoi adhérer ?</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritReseauxSociaux.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/reseaux-sociaux/' ?>">Réseaux sociaux</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritPartenaires.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/partenaires/' ?>">Partenaires</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritReseauAssociatif.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/reseau-associatif/' ?>">Réseau associatif</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritUniversite.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/universite/' ?>">Université d'Orléans</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritPoles.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/poles/' ?>">Pôles</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritFonctionnement.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/fonctionnement/' ?>">Fonctionnement de l'association</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritHistorique.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/historique/' ?>">Historique de l'association</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritContact.php' ? ' active' : ''; ?>" href="<?php echo $prefixe . 'association/contact/' ?>">Contact</a></li>
                </ul>
            </li>
            <li class="nav-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritEvents.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo $prefixe . 'events/' ?>">Évents</a>
            </li>
            <li class="nav-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritGoodies.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo $prefixe . 'goodies/' ?>">Goodies</a>
            </li>
            <li class="nav-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritJournaux.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo $prefixe . 'journaux/' ?>">Journaux</a>
            </li>
            <li class="nav-item<?php echo $gabarit == $prefixe . '-mvc/vue/gabaritsPublic/gabaritArticles.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo $prefixe . 'articles/' ?>">Articles</a>
            </li>
        </ul>
    </div>
</nav>
