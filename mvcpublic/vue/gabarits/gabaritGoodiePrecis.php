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
                <a href="#">Mais c'est quoi un adhérent ?</a>
            </div>
            <div class="well">
                <h3>Quelques mots sur cette merveille...</h3>
                <p>
                    <?php echo $descStr ?>
                </p>
            </div>
        </div>
    </div>
</div><br>