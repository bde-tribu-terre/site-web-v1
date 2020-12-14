<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un article vidéo</h3>
                <hr>
                <form id="formSupprimerArticleVideo" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formSupprimerArticleVideo_id">
                            Article vidéo
                        </label>
                        <select
                                id="formSupprimerArticleVideo_id"
                                name="formSupprimerArticleVideo_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un article vidéo--</option>
                            <?php echo ARTICLES_VIDEO ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">
                        ⚠️ Cette action est irréversible !
                    </small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer article -->
                        <input
                                id="formSupprimerArticleVideo_supprimer_submit"
                                name="formSupprimerArticleVideo_supprimer_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Supprimer l'article vidéo"
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
