<div class="jumbotron">
    <div class="container text-center">
        <a href="<?php echo $prefixe ?>">
            <img src="<?php echo $prefixe . 'global/images/imgLogoMini.png' ?>" alt="Logo" height="300">
        </a>
        <p>Association des étudiants en Science de l'Université d'Orléans</p>
    </div>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationHeader"> <!-- C'est le petit bouton menu quand l'écran est trop petit -->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navigationHeader"> <!-- Et ça c'est quand l'écran est assez grand -->
            <ul class="nav navbar-nav">
                <li<?php if ($gabarit == $prefixe . '-mvc-public/vue/gabarits/gabaritAccueil.php') { echo ' class="active"'; } ?>><a href="<?php echo $prefixe ?>">Accueil</a></li>
                <li<?php if ($gabarit == $prefixe . '-mvc-public/vue/gabarits/gabaritQuiSommesNous.php') { echo ' class="active"'; } ?>><a href="<?php echo $prefixe . 'qui-sommes-nous/' ?>">Qui sommes-nous ?</a></li>
                <li<?php if ($gabarit == $prefixe . '-mvc-public/vue/gabarits/gabaritEvents.php') { echo ' class="active"'; } ?>><a href="<?php echo $prefixe . 'events/' ?>">Évents</a></li>
                <li<?php if ($gabarit == $prefixe . '-mvc-public/vue/gabarits/gabaritGoodies.php') { echo ' class="active"'; } ?>><a href="<?php echo $prefixe . 'goodies/' ?>">Goodies</a></li>
                <li<?php if ($gabarit == $prefixe . '-mvc-public/vue/gabarits/gabaritJournaux.php') { echo ' class="active"'; } ?>><a href="<?php echo $prefixe . 'journaux/' ?>">Journaux</a></li>
            </ul>
            <!-- Bouton se connecter
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
            -->
        </div>
    </div>
</nav>
