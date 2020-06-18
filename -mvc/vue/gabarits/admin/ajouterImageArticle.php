<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter une image à un article</h3>
                <hr>
                <form
                        id="formAjouterImageArticle"
                        method="post"
                        enctype="multipart/form-data"
                        onsubmit="return verifForm(this);"
                >
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formAjouterImageArticle_id">
                            Article
                        </label>
                        <select
                                id="formAjouterImageArticle_id"
                                name="formAjouterImageArticle_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un article--</option>
                            <?php echo ARTICLES ?>
                        </select>
                    </div>
                    <div class="div-group"> <!-- Image -->
                        <label for="formAjouterImageArticle_image">
                            Sélectionner l'image
                        </label>
                        <input
                                id="formAjouterImageArticle_image"
                                name="formAjouterImageArticle_image"
                                type="file"
                                class="form-control"
                                accept="image/*"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            ⚠️ Format : 4:3, pour éviter que ça nique la mise en page.<br>
                            🙏 Taille : 960px*720px.
                        </small>
                    </div>
                    <hr>
                    <p> <!-- Ajouter l'image de l'article -->
                        <input
                                id="formAjouterImageArticle_ajouter_submit"
                                name="formAjouterImageArticle_ajouter_submit"
                                type="submit"
                                class="btn btn-danger btn-block"
                                value="Ajouter l'image"
                        >
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