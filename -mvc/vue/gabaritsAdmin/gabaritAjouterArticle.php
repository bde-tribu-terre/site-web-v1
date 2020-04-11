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
                <h3>Ajouter un article vidéo</h3>
                <hr>
                <form id="formAjouterArticleVideo" method="post">
                    <div class="form-group"> <!-- Titre de l'article -->
                        <label for="formAjouterArticleVideo_titre">Titre de l'article</label>
                        <input class="form-control" id="formAjouterArticleVideo_titre" type="text" placeholder="Titre" name="formAjouterArticleVideo_titre">
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formAjouterArticleVideo_categorie">Catégorie</label>
                        <select class="form-control" id="formAjouterArticleVideo_categorie" name="formAjouterArticleVideo_categorie">
                            <option value="-1">--Choisir--</option>
                            <?php echo $categories ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Visibilité -->
                        <label for="formAjouterArticleVideo_visibilite">Visibilité</label>
                        <select class="form-control" id="formAjouterArticleVideo_visibilite" name="formAjouterArticleVideo_visibilite">
                            <option value="-1">--Choisir--</option>
                            <option value="0">Invisible</option>
                            <option value="1">Visible</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Texte -->
                        <label for="formAjouterArticleVideo_texte">Texte de l'article</label>
                        <textarea class="form-control" id="formAjouterArticleVideo_texte" placeholder="Texte de l'article" name="formAjouterArticleVideo_texte" rows="20"></textarea>
                        <small class="form-text text-muted">Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.</small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter l'article vidéo-->
                        <input class="btn btn-primary btn-block" type="submit" value="Ajouter l'article video" name="formAjouterArticleVideo_ajouter">
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
                        <input class="btn btn-primary btn-block" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>