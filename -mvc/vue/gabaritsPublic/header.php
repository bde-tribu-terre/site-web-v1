<div class="jumbotron">
    <div class="container text-center">
        <a href="<?php echo RACINE ?>">
            <img src="<?php echo RACINE . '-images/imgLogoMini.png' ?>" alt="Logo" height="300">
        </a>
        <p>Association des Étudiants en Science de l'Université d'Orléans</p>
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
            <li class="nav-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritAccueil.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo RACINE ?>">Accueil</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Présentation <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritPresentation.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/' ?>">Qui sommes-nous ?</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritPourquoiAdherer.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/pourquoi-adherer/' ?>">Pourquoi adhérer ?</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritReseauxSociaux.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/reseaux-sociaux/' ?>">Réseaux sociaux</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritPartenaires.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/partenaires/' ?>">Partenaires</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritReseauAssociatif.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/reseau-associatif/' ?>">Réseau associatif</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritUniversite.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/universite/' ?>">Université d'Orléans</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritPoles.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/poles/' ?>">Pôles</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritFonctionnement.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/fonctionnement/' ?>">Fonctionnement de l'association</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritStatuts.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/fonctionnement/statuts' ?>">Statuts</a></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritHistorique.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/historique/' ?>">Historique de l'association</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritContact.php' ? ' active' : ''; ?>" href="<?php echo RACINE . 'association/contact/' ?>">Contact</a></li>
                </ul>
            </li>
            <li class="nav-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritEvents.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo RACINE . 'events/' ?>">Évents</a>
            </li>
            <li class="nav-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritGoodies.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo RACINE . 'goodies/' ?>">Goodies</a>
            </li>
            <li class="nav-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritJournaux.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo RACINE . 'journaux/' ?>">Journaux</a>
            </li>
            <li class="nav-item<?php echo $gabarit == RACINE . '-mvc/vue/gabaritsPublic/gabaritArticles.php' ? ' active' : ''; ?>">
                <a class="nav-link" href="<?php echo RACINE . 'articles/' ?>">Articles</a>
            </li>
        </ul>
    </div>
</nav>
