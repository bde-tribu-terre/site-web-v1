<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h3>Tous nos goodies !</h3>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
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
        <div class="col-sm-4">
            <h3>Prochains évents !</h3>
            <?php echo $events ?>
        </div>
    </div>
    <hr>
</div>

<div class="container text-center">
    <h3>Retrouvez-nous sur les réseaux !</h3>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="well">
                <h4>Notre page Facebook</h4>
                <a href="https://www.facebook.com/bdeTribuTerre/">
                    <p>
                        <img src="<?php echo $prefixe . 'global/images/imgFacebook.svg' ?>" height="64" width="64" alt="Facebook">
                        facebook.com/bdeTribuTerre
                    </p>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <h4>Notre compte Instagram</h4>
                <a href="https://www.instagram.com/tribu.terre/">
                    <p>
                        <img src="<?php echo $prefixe . 'global/images/imgInstagram.svg' ?>" height="64" width="64" alt="Instagram">
                        instagram.com/tribu.terre
                    </p>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <h4>Notre compte Twitter</h4>
                <a href="https://twitter.com/Tributerre45/">
                    <p>
                        <img src="<?php echo $prefixe . 'global/images/imgTwitter.svg' ?>" height="64" width="64" alt="Twitter">
                        twitter.com/Tributerre45
                    </p>
                </a>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="container text-center">
    <h3>Nos partenaires</h3>
    <p>Profitez d'avantages sur présentation de votre carte d'adhérent Tribu-Terre !</p>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="well">
                <h4>Bar L'Atelier</h4>
                <p>203 rue de Bourgogne, Orléans</p>
                <a href="https://www.facebook.com/LAtelier-203-255887947799605/">
                    <p>
                        <img src="<?php echo $prefixe . 'global/images/imgFacebook.svg' ?>" height="20" width="20" alt="Facebook">
                        Page Facebook
                    </p>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <h4>Bar Le Key West</h4>
                <p>208 rue de Bourgogne, Orléans</p>
                <a href="https://www.facebook.com/Key-West-Rhumerie-318605488186473/">
                    <p>
                        <img src="<?php echo $prefixe . 'global/images/imgFacebook.svg' ?>" height="20" width="20" alt="Facebook">
                        Page Facebook
                    </p>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <h4>Bar Le Petit Barcelone</h4>
                <p>218 rue de Bourgogne, Orléans</p>
                <a href="https://www.facebook.com/leptitbarc/">
                    <p>
                        <img src="<?php echo $prefixe . 'global/images/imgFacebook.svg' ?>" height="20" width="20" alt="Facebook">
                        Page Facebook
                    </p>
                </a>
            </div>
        </div>
    </div>
</div><br>