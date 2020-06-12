<div class="container text-center">
    <?php require_once CHEMIN_VERS_MESSAGES ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter une image à un article</h3>
                <hr>
                <form id="formAjouterImageArticle" method="post" enctype="multipart/form-data" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formAjouterImageArticle_id">Article</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formAjouterImageArticle_id" name="formAjouterImageArticle_id">
                            <option value="">--Choisir un article--</option>
                            <?php echo ARTICLES ?>
                        </select>
                    </div>
                    <div class="div-group"> <!-- Image -->
                        <label for="formAjouterImageArticle_image">Sélectionner l'image</label>
                        <input onblur="verifNonVide(this);" class="form-control" type="file" id="formAjouterImageArticle_image" name="formAjouterImageArticle_image" accept="image/*">
                        <small class="form-text text-muted">⚠️ Format : 4:3, pour éviter que ça nique la mise en page.<br>🙏 Taille : 960px*720px.</small>
                    </div>
                    <hr>
                    <p> <!-- Ajouter l'image de l'article -->
                        <input class="btn btn-danger btn-block" type="submit" value="Ajouter l'image" name="formAjouterImageArticle_ajouter">
                    </p>
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