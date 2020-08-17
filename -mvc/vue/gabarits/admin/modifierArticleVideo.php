<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Modifier un article vidéo</h3>
                <hr>
                <form id="formModifierArticleVideo" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- ID de l'article -->
                        <label for="formModifierArticleVideo_id">
                            ID de l'article vidéo
                        </label>
                        <input
                                id="formModifierArticleVideo_id"
                                name="formModifierArticleVideo_id"
                                type="text"
                                class="form-control"
                                readonly
                                value="<?php echo ID ?>"
                                onblur="verifNonVide(this);"
                        >
                    </div>
                    <div class="form-group"> <!-- Titre de l'article -->
                        <label for="formModifierArticleVideo_titre">
                            Titre de l'article vidéo
                        </label>
                        <input
                                id="formModifierArticleVideo_titre"
                                name="formModifierArticleVideo_titre"
                                type="text"
                                class="form-control"
                                value="<?php echo TITRE ?>"
                                placeholder="Titre"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 128);"
                        >
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formModifierArticleVideo_categorie">
                            Catégorie
                        </label>
                        <select
                                id="formModifierArticleVideo_categorie"
                                name="formModifierArticleVideo_categorie"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <?php echo CATEGORIES ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Visibilité -->
                        <label for="formModifierArticleVideo_visibilite">
                            Visibilité
                        </label>
                        <select
                                id="formModifierArticleVideo_visibilite"
                                name="formModifierArticleVideo_visibilite"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="0"<?php echo VISIBILITE == 0 ? ' selected' : ''; ?>>Invisible</option>
                            <option value="1"<?php echo VISIBILITE == 1 ? ' selected' : ''; ?>>Visible</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Lien de la vidéo -->
                        <label for="formModifierArticleVideo_lien">
                            Lien de la vidéo
                        </label>
                        <input
                                id="formModifierArticleVideo_lien"
                                name="formModifierArticleVideo_lien"
                                type="text"
                                class="form-control"
                                placeholder="Lien"
                                value="<?php echo LIEN ?>"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 256);"
                        >
                        <small class="form-text text-muted">
                            Exemple : https://www.youtube.com/watch?v=D38EUIll1pM
                        </small>
                    </div>
                    <div class="form-group"> <!-- Texte -->
                        <label for="formModifierArticleVideo_texte">
                            Texte de l'article vidéo
                        </label>
                        <textarea
                                id="formModifierArticleVideo_texte"
                                name="formModifierArticleVideo_texte"
                                class="form-control"
                                rows="20"
                                placeholder="Texte de l'article"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 7999);"
                        ><?php echo TEXTE ?></textarea>
                        <small class="form-text text-muted">
                            Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.
                        </small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Modifier l'article -->
                        <input
                                id="formModifierArticleVideo_modifier_submit"
                                name="formModifierArticleVideo_modifier_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Modifier l'article vidéo"
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