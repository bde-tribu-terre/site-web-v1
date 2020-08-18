<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Modifier un article</h3>
                <hr>
                <form id="formModifierArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Supprimer des images de l'article -->
                        <input
                                id="formModifierArticle_supprimerImages_submit"
                                name="formModifierArticle_supprimerImages_submit"
                                type="submit"
                                class="btn btn-var"
                                value="Supprimer des images de l'article"
                        >
                    </div>
                    <div class="form-group"> <!-- ID de l'article -->
                        <label for="formModifierArticle_id">
                            ID de l'article
                        </label>
                        <input
                                id="formModifierArticle_id"
                                name="formModifierArticle_id"
                                type="text"
                                class="form-control"
                                readonly
                                value="<?php echo ID ?>"
                                onblur="verifNonVide(this);"
                        >
                    </div>
                    <div class="form-group"> <!-- Titre de l'article -->
                        <label for="formModifierArticle_titre">
                            Titre de l'article
                        </label>
                        <input
                                id="formModifierArticle_titre"
                                name="formModifierArticle_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                value="<?php echo TITRE ?>"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(input, 128);"
                        >
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formModifierArticle_categorie">
                            Catégorie
                        </label>
                        <select
                                id="formModifierArticle_categorie"
                                name="formModifierArticle_categorie"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <?php echo CATEGORIES ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Visibilité -->
                        <label for="formModifierArticle_visibilite">
                            Visibilité
                        </label>
                        <select
                                id="formModifierArticle_visibilite"
                                name="formModifierArticle_visibilite"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="0"<?php echo VISIBILITE == 0 ? ' selected' : ''; ?>>Invisible</option>
                            <option value="1"<?php echo VISIBILITE == 1 ? ' selected' : ''; ?>>Visible</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Texte -->
                        <label for="formModifierArticle_texte">
                            Texte de l'article
                        </label>
                        <textarea
                                id="formModifierArticle_texte"
                                name="formModifierArticle_texte"
                                class="form-control"
                                rows="20"
                                placeholder="Texte de l'article"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(input, 7999);"
                        ><?php echo TEXTE ?></textarea>
                        <small class="form-text text-muted">
                            Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.
                        </small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Modifier l'article -->
                        <input
                                id="formModifierArticle_modifier_submit"
                                name="formModifierArticle_modifier_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Modifier l'article"
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