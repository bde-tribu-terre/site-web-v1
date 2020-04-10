<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (!empty($messageRetour)) {
                echo
                    '<div class="well">' .
                    '<h3>Message : </h3>' .
                    '<p><strong>' . $messageRetour . '</strong></p>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un article</h3>
                <hr>
                <form id="formModifierArticle" method="post">
                    <div class="form-group"> <!-- ID de l'article -->
                        <label for="formModifierArticle_idArticle">ID de l'article</label>
                        <input class="form-control" id="formModifierArticle_idArticle" type="text" value="<?php echo $idArticle ?>" name="formModifierArticle_idArticle" readonly>
                    </div>
                    <div class="form-group"> <!-- Titre de l'article -->
                        <label for="formModifierArticle_titre">Titre de l'article</label>
                        <input class="form-control" id="formModifierArticle_titre" type="text" value="<?php echo $titreArticle ?>" placeholder="Titre" name="formModifierArticle_titre">
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formModifierArticle_categorie">Catégorie</label>
                        <select class="form-control" id="formModifierArticle_categorie" name="formModifierArticle_categorie">
                            <?php echo $categories ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Visibilité -->
                        <label for="formModifierArticle_visibilite">Visibilité</label>
                        <select class="form-control" id="formModifierArticle_visibilite" name="formModifierArticle_visibilite">
                            <option value="0"<?php echo $visibiliteArticle == 0 ? ' selected' : ''; ?>>Invisible</option>
                            <option value="1"<?php echo $visibiliteArticle == 1 ? ' selected' : ''; ?>>Visible</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Texte -->
                        <label for="formModifierArticle_texte">Texte de l'article</label>
                        <textarea class="form-control" id="formModifierArticle_texte" placeholder="Texte de l'article" name="formModifierArticle_texte" rows="20"><?php echo $texteArticle ?></textarea>
                        <small class="form-text text-muted">Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.</small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Modifier l'article -->
                        <input class="btn btn-primary" type="submit" value="Modifier l'article" name="formModifierArticle_modifier">
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
                        <input class="btn btn-primary" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>