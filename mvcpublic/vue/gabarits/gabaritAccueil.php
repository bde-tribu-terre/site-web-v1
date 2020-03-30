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
            <h3>La dernière recette !</h3>
            <div class="well">
                Partie cuisine encore en chantier...
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
                        <img src="<?php echo $prefixe . 'global/images/imgFacebook.svg' ?>" height="64" width="64" alt="Facebook">
                    </p>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="https://www.instagram.com/tribu.terre/">
                <div class="well">
                <h4>Notre compte Instagram</h4>
                    <p>
                        <img src="<?php echo $prefixe . 'global/images/imgInstagram.svg' ?>" height="64" width="64" alt="Instagram">
                    </p>

                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="https://twitter.com/Tributerre45/">
                <div class="well">
                    <h4>Notre compte Twitter</h4>
                    <p>
                        <img src="<?php echo $prefixe . 'global/images/imgTwitter.svg' ?>" height="64" width="64" alt="Twitter">
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
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <!-- Ici on liste les partenaires -->
                <div class="item active">
                    <a href="https://www.facebook.com/LAtelier-203-255887947799605/">
                        <img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
                    </a>
                    <div class="carousel-caption">
                        <a href="https://www.facebook.com/LAtelier-203-255887947799605/">
                            <h3>Bar L'Atelier</h3>
                        </a>
                        <p>203 rue de Bourgogne, Orléans</p>
                    </div>
                </div>

                <div class="item">
                    <a href="https://www.facebook.com/Key-West-Rhumerie-318605488186473/">
                        <img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
                    </a>
                    <div class="carousel-caption">
                        <a href="https://www.facebook.com/Key-West-Rhumerie-318605488186473/">
                            <h3>Bar L'Atelier</h3>
                        </a>
                        <p>203 rue de Bourgogne, Orléans</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div><br>