<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h3>Tous nos goodies !</h3>
            <div id="carouselGoodies" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php echo $goodiesIndicators ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <!-- Ici on liste les goodies -->
                    <?php echo $goodies ?>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#carouselGoodies" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carouselGoodies" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Prochains évents !</h3>
            <?php echo $events ?>
        </div>
    </div>
    <hr>
</div>

<div class="container text-center">
    <div class="row">
        <div class="col-sm-6">
            <h3>Le dernier article !</h3>
            <div class="well">
                <?php echo $article ?>
            </div>
        </div>
        <h3>Les journaux les plus récents !</h3>
        <?php echo $journaux ?>
    </div>
    <hr>
</div>

<div class="container text-center">
    <h3>Retrouvez-nous sur les réseaux !</h3>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <a href="https://www.facebook.com/bdeTribuTerre/">
                <div class="well">
                    <h4>Notre page Facebook</h4>
                    <p>
                        <img src="<?php echo $prefixe . '-images/imgFacebook.svg' ?>" height="64" width="64" alt="Facebook">
                    </p>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="https://www.instagram.com/tribu.terre/">
                <div class="well">
                <h4>Notre compte Instagram</h4>
                    <p>
                        <img src="<?php echo $prefixe . '-images/imgInstagram.svg' ?>" height="64" width="64" alt="Instagram">
                    </p>

                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="https://twitter.com/Tributerre45/">
                <div class="well">
                    <h4>Notre compte Twitter</h4>
                    <p>
                        <img src="<?php echo $prefixe . '-images/imgTwitter.svg' ?>" height="64" width="64" alt="Twitter">
                    </p>
                </div>
            </a>
        </div>
    </div>
    <hr>
</div>

<div class="container text-center">
    <div class="col-sm-4">
        <h3>Nos partenaires !</h3>
        <p>Profitez d'avantages sur présentation de votre carte d'adhérent Tribu-Terre !</p>
        <div id="carouselPartenaires" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carouselPartenaires" data-slide-to="0" class="active"></li>
                <li data-target="#carouselPartenaires" data-slide-to="1"></li>
                <li data-target="#carouselPartenaires" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- Ici on liste les partenaires -->
                <div class="item active">
                    <a href="https://www.facebook.com/LAtelier-203-255887947799605/">
                        <img src="<?php echo $prefixe . '-images/imgBarAtelier.png' ?>" alt="Image">
                    </a>
                    <a href="https://www.facebook.com/LAtelier-203-255887947799605/">
                        <div class="carousel-caption">
                            <h3>Bar L'Atelier</h3>
                            <p>203 rue de Bourgogne, Orléans</p>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a href="https://www.facebook.com/Key-West-Rhumerie-318605488186473/">
                        <img src="<?php echo $prefixe . '-images/imgBarKeyWest.png' ?>" alt="Image">
                    </a>
                    <a href="https://www.facebook.com/Key-West-Rhumerie-318605488186473/">
                        <div class="carousel-caption">
                            <h3>Bar Le Key West</h3>
                            <p>208 rue de Bourgogne, Orléans</p>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a href="https://maestro-snack-orleans.eatbu.com/?lang=fr">
                        <img src="<?php echo $prefixe . '-images/imgLeMaestro.png' ?>" alt="Image">
                    </a>
                    <a href="https://maestro-snack-orleans.eatbu.com/?lang=fr">
                        <div class="carousel-caption">
                            <h3>Le Maestro</h3>
                            <p>218 rue de Bourgogne, Orléans</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#carouselPartenaires" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carouselPartenaires" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <h3>Réseau associatif</h3>
        <p>L'association Tribu-Terre adhère à des fédérations d'associations locale et régionale.</p>
        <div id="carouselFederations" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carouselFederations" data-slide-to="0" class="active"></li>
                <li data-target="#carouselFederations" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- Ici on liste les fédérations -->
                <div class="item active">
                    <a href="https://ocampus.fr/">
                        <img src="<?php echo $prefixe . '-images/imgOCampus.png' ?>" alt="Image">
                    </a>
                    <a href="https://ocampus.fr/">
                        <div class="carousel-caption">
                            <h3>ÔCampus</h3>
                            <p>Fédération des associations étudiantes d'Orléans</p>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a href="http://www.fneb.fr/">
                        <img src="<?php echo $prefixe . '-images/imgFNEB.png' ?>" alt="Image">
                    </a>
                    <a href="http://www.fneb.fr/">
                        <div class="carousel-caption">
                            <h3>FNEB</h3>
                            <p>Fédération Nationale des Étudiants en sciences exactes naturelles et techniques</p>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#carouselFederations" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carouselFederations" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="col-sm-4">
        <h3>Université</h3>
        <p>L'association Tribu-Terre agit en accord avec l'OSUC et le CoST.</p>
        <div id="carouselUniversite" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carouselUniversite" data-slide-to="0" class="active"></li>
                <li data-target="#carouselUniversite" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- Ici on liste les composantes -->
                <div class="item active">
                    <a href="http://www.univ-orleans.fr/fr/osuc">
                        <img src="<?php echo $prefixe . '-images/imgOSUC.png' ?>" alt="Image">
                    </a>
                    <a href="http://www.univ-orleans.fr/fr/osuc">
                        <div class="carousel-caption">
                            <h3>OSUC</h3>
                            <p>Observatoire Sciences de l'Univers en région Centre</p>
                        </div>
                    </a>
                </div>

                <div class="item">
                    <a href="http://www.univ-orleans.fr/fr/sciences-techniques">
                        <img src="<?php echo $prefixe . '-images/imgCoST.png' ?>" alt="Image">
                    </a>
                    <a href="http://www.univ-orleans.fr/fr/sciences-techniques">
                        <div class="carousel-caption">
                            <h3>CoST</h3>
                            <p>Collégium Sciences et Techniques</p>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#carouselUniversite" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carouselUniversite" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div><br>