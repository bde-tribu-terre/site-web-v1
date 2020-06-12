<div class="container text-center">
    <?php require_once CHEMIN_VERS_MESSAGES ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer des images d'un goodie</h3>
                <hr>
                <form id="formSupprimerImageGoodie" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- ID du goodie -->
                        <label for="formSupprimerImageGoodie_id">ID du goodie</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formSupprimerImageGoodie_id" type="text" value="<?php echo ID ?>" name="formSupprimerImageGoodie_id" readonly>
                    </div>
                    <?php echo IMAGES_GOODIE ?>
                    <hr>
                    <div class="form-group"> <!-- Supprimer les images -->
                        <input class="btn btn-danger btn-block" type="submit" value="Supprimer les images" name="formSupprimerImageGoodie_supprimer">
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
                        <input class="btn btn-danger btn-block" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>