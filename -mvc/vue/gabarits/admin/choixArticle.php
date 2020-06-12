<div class="container text-center">
    <?php require_once CHEMIN_VERS_MESSAGES ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Choisir un article à modifier</h3>
                <hr>
                <form id="formChoisirArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formChoisirArticle_id">Article</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formChoisirArticle_id" name="formChoisirArticle_id">
                            <option value="">--Choisir un article--</option>
                            <?php echo ARTICLES ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Article -->
                        <input class="btn btn-danger btn-block" type="submit" value="Choisir l'article" name="formChoisirArticle_choisir">
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