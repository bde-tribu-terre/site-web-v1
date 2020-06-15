<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer des images d'un goodie</h3>
                <hr>
                <form id="formSupprimerImageArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- ID du goodie -->
                        <label for="formSupprimerImageArticle_id">ID de l'article</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formSupprimerImageArticle_id" type="text" value="<?php echo ID ?>" name="formSupprimerImageArticle_id" readonly>
                    </div>
                    <?php echo IMAGES_ARTICLE ?>
                    <hr>
                    <div class="form-group"> <!-- Supprimer les images -->
                        <input class="btn btn-danger btn-block" type="submit" value="Supprimer les images" name="formSupprimerImageArticle_supprimer_submit">
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
                        <input class="btn btn-danger btn-block" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu_submit">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>