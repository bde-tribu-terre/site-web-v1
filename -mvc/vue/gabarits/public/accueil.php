<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h3 class="text-center">Tous nos goodies !</h3>
            <?php echo CAROUSEL_GOODIES ?>
        </div>
        <div class="col-sm-4">
            <h3 class="text-center">Prochains évents !</h3>
            <?php echo EVENTS ?>
        </div>
    </div>
    <hr>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-sm-6">
            <h3>Le dernier article !</h3>
            <?php echo ARTICLE ?>
        </div>
        <div class="col-sm-6">
            <h3>Les journaux les plus récents !</h3>
            <?php echo JOURNAUX ?>
        </div>
    </div>
    <hr>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <h3>Retrouvez-nous sur les réseaux !</h3>
            <br>
            <div class="col-sm-3">
                <a href="https://www.facebook.com/bdeTribuTerre/">
                    <div class="well">
                        <h4>Notre page Facebook</h4>
                        <p>
                            <img src="<?php echo IMAGES . 'imgFacebook.svg' ?>" height="64" width="64" alt="Facebook">
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="https://www.instagram.com/tribu.terre/">
                    <div class="well">
                        <h4>Notre compte Instagram</h4>
                        <p>
                            <img src="<?php echo IMAGES . 'imgInstagram.svg' ?>" height="64" width="64" alt="Instagram">
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="https://twitter.com/Tributerre45/">
                    <div class="well">
                        <h4>Notre compte Twitter</h4>
                        <p>
                            <img src="<?php echo IMAGES . 'imgTwitter.svg' ?>" height="64" width="64" alt="Twitter">
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="https://discord.gg/EfkUuC2">
                    <div class="well">
                        <h4>Notre serveur Discord</h4>
                        <p>
                            <img src="<?php echo IMAGES . 'imgDiscord.svg' ?>" height="64" width="64" alt="Twitter">
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="container text-center">
    <script>
        function activerBoutonInfo(nb) {
            document.getElementById('boutonInfo1').classList.remove('active');
            document.getElementById('boutonInfo2').classList.remove('active');
            document.getElementById('boutonInfo3').classList.remove('active');

            document.getElementById('boutonInfo' + nb).classList.add('active');
        }
    </script>
    <div class="row"> <!-- Boutons pour choisir -->
        <div class="col-sm-4">
            <a id="boutonInfo1" class="btn btn-var btn-block ombre active" type="button" data-slide-to="0" data-target="#carouselInfos" onclick="activerBoutonInfo('1')">
                <h4>Partenaires</h4>
            </a>
            <br>
        </div>
        <div class="col-sm-4">
            <a id="boutonInfo2" class="btn btn-var btn-block ombre" type="button" data-slide-to="1" data-target="#carouselInfos" onclick="activerBoutonInfo('2')">
                <h4>Réseau associatif</h4>
            </a>
            <br>
        </div>
        <div class="col-sm-4">
            <a id="boutonInfo3" class="btn btn-var btn-block ombre" type="button" data-slide-to="2" data-target="#carouselInfos" onclick="activerBoutonInfo('3')">
                <h4>Université</h4>
            </a>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="carouselInfos" class="carousel carousel-infos slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <h3>Partenaires</h3>
                                <p>Tribu-Terre est actuellement partenaire avec trois établissements Rue de Bourgogne.</p>
                                <p>Profitez de tarifs préférentiels sur présentation de votre carte d'adhérent Tribu-Terre !</p>
                                <p>
                                    <a href="<?php echo RACINE . 'association/pourquoi-adherer/' ?>">Comment adhérer ?</a> |
                                    <a href="<?php echo RACINE . 'association/partenaires/' ?>">Voir les tarifs préférentiels</a>
                                </p>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h4>Bar l'Atelier</h4>
                                <p>203 Rue de Bourgogne, Orléans</p>
                                <p>
                                    <a href="https://www.facebook.com/LAtelier-203-255887947799605/">
                                        Page Facebook
                                    </a>
                                </p>
                                <a href="https://www.facebook.com/LAtelier-203-255887947799605/">
                                    <img class="img-arrondi ombre" src="<?php echo IMAGES . 'imgBarAtelier.png' ?>" alt="Bar l'Atelier">
                                </a>
                                <hr class="alterneur-mini">
                            </div>
                            <div class="col-sm-4">
                                <h4>Bar Le Key West</h4>
                                <p>208 Rue de Bourgogne, Orléans</p>
                                <p>
                                    <a href="https://www.facebook.com/Key-West-Rhumerie-318605488186473/">
                                        Page Facebook
                                    </a>
                                </p>
                                <a href="https://www.facebook.com/Key-West-Rhumerie-318605488186473/">
                                    <img class="img-arrondi ombre" src="<?php echo IMAGES . 'imgBarKeyWest.png' ?>" alt="Bar le Key West">
                                </a>
                                <hr class="alterneur-mini">
                            </div>
                            <div class="col-sm-4">
                                <h4>Restaurant Le Maestro</h4>
                                <p>218 Rue de Bourgogne, Orléans</p>
                                <p>
                                    <a href="https://maestro-snack-orleans.eatbu.com/?lang=fr">
                                        Site Web
                                    </a>
                                </p>
                                <a href="https://maestro-snack-orleans.eatbu.com/?lang=fr">
                                    <img class="img-arrondi ombre" src="<?php echo IMAGES . 'imgLeMaestro.png' ?>" alt="Restaurant le Maestro">
                                </a>
                                <hr class="alterneur-mini">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <h3>Réseau associatif</h3>
                                <p>L'association Tribu-Terre est adhérente à deux fédérations d'associations étudiantes.</p>
                                <p>
                                    Elles permettent une mise en relation des étudiants à l'échelle locale pour
                                    l'une et à l'échelle nationale pour l'autre, dans l'objectif d'organiser des
                                    événements et des projets communs.
                                </p>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>ÔCampus</h4>
                                <h5>Fédération des Associations Etudiantes d'Orléans</h5>
                                <p>
                                    <a href="https://fr-fr.facebook.com/OCampusFederation/">
                                        Page Facebook
                                    </a> |
                                    <a href="https://ocampus.fr/index.php">
                                        Site Web
                                    </a>
                                </p>
                                <p>
                                    <a href="<?php echo RACINE . 'association/reseau-associatif/ocampus/' ?>">
                                        Plus d'information sur ÔCampus
                                    </a>
                                </p>
                                <a href="https://ocampus.fr/index.php">
                                    <img class="img-arrondi ombre" src="<?php echo IMAGES . 'imgOCampus.png' ?>" alt="ÔCampus">
                                </a>
                                <hr class="alterneur-mini">
                            </div>
                            <div class="col-sm-6">
                                <h4>FNEB</h4>
                                <h5>Fédération Nationale des Étudiants en sciences exactes naturelles et techniques</h5>
                                <p>
                                    <a href="https://www.facebook.com/FNEBmono">
                                        Page Facebook
                                    </a> |
                                    <a href="https://www.fneb.fr/">
                                        Site Web
                                    </a>
                                </p>
                                <p>
                                    <a href="<?php echo RACINE . 'association/reseau-associatif/fneb/' ?>">
                                        Plus d'information sur la FNEB
                                    </a>
                                </p>
                                <a href="https://www.fneb.fr/">
                                    <img class="img-arrondi ombre" src="<?php echo IMAGES . 'imgFNEB.png' ?>" alt="FNEB">
                                </a>
                                <hr class="alterneur-mini">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <h3>Université</h3>
                                <p>
                                    L'association Tribu-Terre agit en accord avec les composantes géologique
                                    (OSUC) et scientifique (CoST) de l'Université d'Orléans.
                                </p>
                                <p>
                                    <a href="<?php echo RACINE . 'association/universite/' ?>">
                                        Plus d'informations sur l'Université d'Orléans.
                                    </a>
                                </p>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>OSUC</h4>
                                <h5>Observatoire des Sciences de l’Univers en région Centre</h5>
                                <p>
                                    <a href="http://www.univ-orleans.fr/fr/osuc">
                                        Site Web
                                    </a>
                                </p>
                                <a href="http://www.univ-orleans.fr/fr/osuc">
                                    <img src="<?php echo IMAGES . 'imgOSUC2.png' ?>" alt="OSUC">
                                </a>
                                <hr class="alterneur-mini">
                            </div>
                            <div class="col-sm-6">
                                <h4>CoST</h4>
                                <h5>Collégium Sciences et Techniques</h5>
                                <p>
                                    <a href="http://www.univ-orleans.fr/fr/sciences-techniques/">
                                        Site Web
                                    </a>
                                </p>
                                <a href="http://www.univ-orleans.fr/fr/sciences-techniques/">
                                    <img src="<?php echo IMAGES . 'imgCoST2.png' ?>" alt="CoST">
                                </a>
                                <hr class="alterneur-mini">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>