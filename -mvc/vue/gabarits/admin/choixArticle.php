<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Choisir un article à modifier</h3>
                <hr>
                <form id="formChoisirArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formChoisirArticle_id">
                            Article
                        </label>
                        <select
                                id="formChoisirArticle_id"
                                name="formChoisirArticle_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un article--</option>
                            <?php echo ARTICLES ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Article -->
                        <input
                                id="formChoisirArticle_choisir_submit"
                                name="formChoisirArticle_choisir_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Choisir l'article"
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
