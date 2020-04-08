<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (!empty($messageRetour)) {
                echo
                    '<div class="well">' .
                    '<h3>Message : </h3>' .
                    '<p><strong>' . $messageRetour . '</strong></p>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un goodie</h3>
                <hr>
                <form id="formSupprimerGoodie" method="post">
                    <div class="form-group"> <!-- Goodie en question -->
                        <label for="formSupprimerGoodie_idGoodie">Goodie :</label>
                        <select class="form-control" id="formSupprimerGoodie_idGoodie" name="formSupprimerGoodie_idGoodie">
                            <option value="">--Choisir un goodie--</option>
                            <?php echo $goodies ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">⚠️ Cette action est irréversible !</small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer goodie -->
                        <input class="btn btn-primary" type="submit" value="Supprimer le goodie" name="formSupprimerGoodie_supprimer">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Retour au menu</h3>
                <hr>
                <form id="formRetourMenu" method="post">
                    <p> <!-- Retour au menu -->
                        <input class="btn btn-primary" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>