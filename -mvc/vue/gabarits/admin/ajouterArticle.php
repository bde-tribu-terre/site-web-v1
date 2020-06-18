<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un article</h3>
                <hr>
                <form id="formAjouterArticleVideo" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Titre de l'article -->
                        <label for="formAjouterArticle_titre">
                            Titre de l'article
                        </label>
                        <input
                                id="formAjouterArticle_titre"
                                name="formAjouterArticle_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 128);"
                        >
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formAjouterArticle_categorie">
                            Catégorie
                        </label>
                        <select
                                id="formAjouterArticle_categorie"
                                name="formAjouterArticle_categorie"
                                class="form-control"
                                onblur="verifNonMoins1(this);"
                        >
                            <option value="-1">--Choisir--</option>
                            <?php echo CATEGORIES ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Visibilité -->
                        <label for="formAjouterArticle_visibilite">
                            Visibilité
                        </label>
                        <select
                                id="formAjouterArticle_visibilite"
                                name="formAjouterArticle_visibilite"
                                class="form-control"
                                onblur="verifNonMoins1(this);"
                        >
                            <option value="-1">--Choisir--</option>
                            <option value="0">Invisible</option>
                            <option value="1">Visible</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Texte -->
                        <label for="formAjouterArticle_texte">
                            Texte de l'article
                        </label>
                        <textarea
                                id="formAjouterArticle_texte"
                                name="formAjouterArticle_texte"
                                class="form-control"
                                rows="20"
                                placeholder="Texte de l'article"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 7999);"
                        ></textarea>
                        <small class="form-text text-muted">
                            Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.
                        </small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter l'article vidéo-->
                        <input
                                id="formAjouterArticle_ajouter_submit"
                                name="formAjouterArticle_ajouter_submit"
                                type="submit"
                                class="btn btn-danger btn-block"
                                value="Ajouter l'article"
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