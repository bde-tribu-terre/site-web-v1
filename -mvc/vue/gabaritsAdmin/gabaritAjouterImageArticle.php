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
                <h3>Ajouter une image à un article</h3>
                <hr>
                <form id="formAjouterImageArticle" method="post" enctype="multipart/form-data">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formAjouterImageArticle_idArticle">Article</label>
                        <select class="form-control" id="formAjouterImageArticle_idArticle" name="formAjouterImageArticle_idArticle">
                            <option value="">--Choisir un article--</option>
                            <?php echo $articles ?>
                        </select>
                    </div>
                    <div class="div-group"> <!-- Image -->
                        <label for="formAjouterImageArticle_image">Sélectionner l'image</label>
                        <input class="form-control" type="file" name="formAjouterImageArticle_image" accept="image/*">
                        <small class="form-text text-muted">⚠️ Format : 4:3, pour éviter que ça nique la mise en page.<br>🙏 Taille : 960px*720px.<br>⚠️ La miniature compte déjà comme une image. Attention aux doublons !</small>
                    </div>
                    <hr>
                    <p> <!-- Ajouter l'image de l'article -->
                        <input class="btn btn-primary btn-block" type="submit" value="Ajouter l'image" name="formAjouterImageArticle_ajouter">
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
                        <input class="btn btn-primary btn-block" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>