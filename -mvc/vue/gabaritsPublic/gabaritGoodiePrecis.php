<div class="container text-center">
    <h3><?php echo $titreGoodie ?></h3>
    <hr>
    <div class="row">
        <div class="col-sm-8">
            <?php echo $carouselGoodie ?>
        </div>
        <div class="col-sm-4">
            <div class="well">
                <h3>Prix pour les adhérents</h3>
                <h1><?php echo $prixAdherent ?>€</h1>
                <hr>
                <h3>Prix pour les non-adhérents</h3>
                <h1><?php echo $prixNonAdherent ?>€</h1>
                <hr>
                <button class="btn btn-danger btn-block" type="button" data-toggle="collapse" data-target="#adherent" aria-expanded="false">
                    Qu'est-ce qu'un adhérent ?
                </button>
                <div class="collapse" id="adherent">
                    <div class="card card-body">
                        <br>
                        <p>Un adhérent est une personne ayant payé le prix d'adhésion auprès du bureau de Tribu-Terre.</p>
                        <p>Le prix de l'adhésion est fixé à 5€. L'adhésion est valable pour toute la durée de l'année universitaire.</p>
                        <p>Devenir adhérent à Tribu-Terre, c'est non seulement pouvoir acheter les goodies à prix réduit, mais c'est aussi bénéficier de tarifs préférentiels chez nos partenaires !</p>
                        <a href="<?php echo $prefixe . 'association/pourquoi-adherer/' ?>"><p>En savoir plus sur les avantages de l'adhésion !</p></a>
                    </div>
                </div>
                <br>
                <br>
                <button class="btn btn-danger btn-block" type="button" data-toggle="collapse" data-target="#recherche" aria-expanded="false">
                    Comment acheter ?
                </button>
                <div class="collapse" id="recherche"">
                    <div class="card card-body">
                        <br>
                        <p>Pour acheter ce goodie, rendez-vous au local Tribu-Terre !</p>
                        <a href="<?php echo $prefixe . 'association/ou-nous-trouver/' ?>"><p>Où est notre local ?</p></a>
                        <br>
                        <p>Nous organisons également régulièrement des permanences dans le hall du bâtiment S !</p>
                        <a href="<?php echo $prefixe . 'association/reseaux-sociaux/' ?>"><p>Tenez-vous informé sur nos réseaux !</p></a>
                        <br>
                        <p>Certains de nos goodies peuvent être achetés pendant nos évents !</p>
                        <a href="<?php echo $prefixe . 'events/' ?>"><p>Quels sont les prochains events ?</p></a>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="well">
            <h3>Quelques mots sur cette merveille...</h3>
            <p>
                <?php echo $descStr ?>
            </p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <!-- Twitter -->
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
               class="twitter-share-button"
               data-size="large"
               data-text="Ce goodie de Tribu-Terre a l'air d'être de qualité : <?php echo $titre ?> !"
               data-via="Tributerre45"
               data-show-count="false">
                Tweet
            </a>
            <script async
                    src="https://platform.twitter.com/widgets.js"
                    charset="utf-8">
            </script>
            <!-- Facebook -->
            <div id="fb-root"></div>
            <script>
                (
                    function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk')
                );
            </script>
            <div class="fb-share-button"
                 data-href="http://barodine.fr/tribu-terre/goodies?id=<?php echo $id ?>"
                 data-layout="button"
                 data-size="large">
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                   class="fb-xfbml-parse-ignore">Partager</a>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div><br>