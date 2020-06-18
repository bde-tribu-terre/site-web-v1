<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un article</h3>
                <hr>
                <form id="formSupprimerArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formSupprimerArticle_id">
                            Article
                        </label>
                        <select
                                id="formSupprimerArticle_id"
                                name="formSupprimerArticle_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un article--</option>
                            <?php echo ARTICLES ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">
                        ⚠️ Cette action est irréversible !
                    </small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer article -->
                        <input
                                id="formSupprimerArticle_supprimer_submit"
                                name="formSupprimerArticle_supprimer_submit"
                                type="submit"
                                class="btn btn-danger btn-block"
                                value="Supprimer l'article"
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
                                class="btn btn-danger btn-block"
                                value="Retour au menu"
                        >
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>