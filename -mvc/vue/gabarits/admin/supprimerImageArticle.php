<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer des images d'un goodie</h3>
                <hr>
                <form id="formSupprimerImageArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- ID du goodie -->
                        <label for="formSupprimerImageArticle_id">
                            ID de l'article
                        </label>
                        <input
                                id="formSupprimerImageArticle_id"
                                name="formSupprimerImageArticle_id"
                                type="text"
                                class="form-control"
                                readonly
                                value="<?php echo ID ?>"
                                onblur="verifNonVide(this);"
                        >
                    </div>
                    <?php echo IMAGES_ARTICLE ?>
                    <hr>
                    <div class="form-group"> <!-- Supprimer les images -->
                        <input
                                id="formSupprimerImageArticle_supprimer_submit"
                                name="formSupprimerImageArticle_supprimer_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Supprimer les images"
                        >
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
                        <input
                                id="formRetourMenu_retourMenu_submit"
                                name="formRetourMenu_retourMenu_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Retour au menu"
                        >
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
