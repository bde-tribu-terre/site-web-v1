<div class="jumbotron">
    <div class="container text-center">
        <a href="<?php echo RACINE ?>">
            <img class="logo-jumbotron" src="<?php echo IMAGES .'imgLogoMini.png' ?>" alt="Logo" height="300">
        </a>
        <p class="texte-jumbotron">Association des Étudiants en Science de l'Université d'Orléans</p>
    </div>
</div>

<nav class="navbar navbar-expand-sm py-0">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationHeader"> <!-- C'est le petit bouton menu quand l'écran est trop petit -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="navbar-collapse collapse" id="navigationHeader"> <!-- Et ça c'est quand l'écran est assez grand -->
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo RACINE ?>">Accueil</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Présentation <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/' ?>">Qui sommes-nous ?</a></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/pourquoi-adherer/' ?>">Pourquoi adhérer ?</a></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/ou-nous-trouver/' ?>">Où nous trouver ?</a></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/reseaux-sociaux/' ?>">Réseaux sociaux</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/partenaires/' ?>">Partenaires</a></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/reseau-associatif/' ?>">Réseau associatif</a></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/universite/' ?>">Université d'Orléans</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/trombinoscope/' ?>">Trombinoscope</a></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/fonctionnement/' ?>">Fonctionnement de l'association</a></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/fonctionnement/statuts' ?>">Statuts</a></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/historique/' ?>">Historique de l'association</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item" href="<?php echo RACINE . 'association/contact/' ?>">Contact</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RACINE . 'events/' ?>">Évents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RACINE . 'goodies/' ?>">Goodies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RACINE . 'journaux/' ?>">Journaux</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RACINE . 'articles/' ?>">Articles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RACINE . 'trouver-une-salle/' ?>">Trouver une salle</a>
            </li>
        </ul>
    </div>
</nav>

<?php require_once CHEMIN_VERS_MESSAGES ?>