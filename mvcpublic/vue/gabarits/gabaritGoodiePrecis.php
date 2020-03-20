<div class="container text-center">
    <h3><?php echo $nomGoodie ?></h3>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <?php echo $carouselGoodie ?>
        </div>
    </div>
    <hr>
    <div class="row">
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
        </div>
        <div class="col-sm-8">
            <div class="well">
                <h3>Quelques mots sur cette merveille...</h3>
                <p>
                    <?php echo $descGoodie ?>
                </p>
            </div>
        </div>
    </div>
    <hr>
</div><br>