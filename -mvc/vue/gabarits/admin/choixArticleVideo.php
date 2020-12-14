<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Choisir un article vidéo à modifier</h3>
                <hr>
                <form id="formChoisirArticleVideo" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formChoisirArticleVideo_id">
                            Article vidéo
                        </label>
                        <select
                                id="formChoisirArticleVideo_id"
                                name="formChoisirArticleVideo_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un article vidéo--</option>
                            <?php echo ARTICLES_VIDEO ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Article Vidéo -->
                        <input
                                id="formChoisirArticleVideo_choisir_submit"
                                name="formChoisirArticleVideo_choisir_submit"
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
