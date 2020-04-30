<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (!empty(MESSAGE_RETOUR)) {
                echo
                    '<div class="well">' .
                    '<h3>Message : </h3>' .
                    '<p><strong>' . MESSAGE_RETOUR . '</strong></p>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Modifier un article vidéo</h3>
                <hr>
                <form id="formModifierArticleVideo" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- ID de l'article -->
                        <label for="formModifierArticleVideo_idArticle">ID de l'article vidéo</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formModifierArticleVideo_idArticle" type="text" value="<?php echo ID ?>" name="formModifierArticleVideo_idArticle" readonly>
                    </div>
                    <div class="form-group"> <!-- Titre de l'article -->
                        <label for="formModifierArticleVideo_titre">Titre de l'article vidéo</label>
                        <input onblur="verifNonVide(this);" oninput="garderMoins(input, 128);" class="form-control" id="formModifierArticleVideo_titre" type="text" value="<?php echo TITRE ?>" placeholder="Titre" name="formModifierArticleVideo_titre">
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formModifierArticleVideo_categorie">Catégorie</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formModifierArticleVideo_categorie" name="formModifierArticleVideo_categorie">
                            <?php echo CATEGORIES ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Visibilité -->
                        <label for="formModifierArticleVideo_visibilite">Visibilité</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formModifierArticleVideo_visibilite" name="formModifierArticleVideo_visibilite">
                            <option value="0"<?php echo VISIBILITE == 0 ? ' selected' : ''; ?>>Invisible</option>
                            <option value="1"<?php echo VISIBILITE == 1 ? ' selected' : ''; ?>>Visible</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Lien de la vidéo -->
                        <label for="formModifierArticleVideo_lien">Lien de la vidéo</label>
                        <input onblur="verifNonVide(this);" oninput="garderMoins(input, 256);" class="form-control" id="formModifierArticleVideo_lien" type="text" value="<?php echo LIEN ?>" placeholder="Lien" name="formModifierArticleVideo_lien">
                        <small class="form-text text-muted">Exemple : http://www.youtube.com/watch?v=B4CRkpBGQzU</small>
                    </div>
                    <div class="form-group"> <!-- Texte -->
                        <label for="formModifierArticleVideo_texte">Texte de l'article vidéo</label>
                        <textarea onblur="verifNonVide(this);" oninput="garderMoins(input, 7999);" class="form-control" id="formModifierArticleVideo_texte" placeholder="Texte de l'article" name="formModifierArticleVideo_texte" rows="20"><?php echo TEXTE ?></textarea>
                        <small class="form-text text-muted">Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.</small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Modifier l'article -->
                        <input class="btn btn-danger btn-block" type="submit" value="Modifier l'article vidéo" name="formModifierArticleVideo_modifier">
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