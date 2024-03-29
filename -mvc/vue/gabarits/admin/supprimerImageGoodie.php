<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer des images d'un goodie</h3>
                <hr>
                <form id="formSupprimerImageGoodie" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- ID du goodie -->
                        <label for="formSupprimerImageGoodie_id">
                            ID du goodie
                        </label>
                        <input
                                id="formSupprimerImageGoodie_id"
                                name="formSupprimerImageGoodie_id"
                                type="text"
                                class="form-control"
                                readonly
                                value="<?php echo ID ?>"
                                onblur="verifNonVide(this);"
                        >
                    </div>
                    <?php echo IMAGES_GOODIE ?>
                    <hr>
                    <div class="form-group"> <!-- Supprimer les images -->
                        <input
                                id="formSupprimerImageGoodie_supprimer_submit"
                                name="formSupprimerImageGoodie_supprimer_submit"
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
