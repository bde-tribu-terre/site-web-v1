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
                <h3>Supprimer un article vidéo</h3>
                <hr>
                <form id="formSupprimerArticleVideo" method="post">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formSupprimerArticleVideo_idArticle">Article vidéo</label>
                        <select class="form-control" id="formSupprimerArticleVideo_idArticle" name="formSupprimerArticleVideo_idArticle">
                            <option value="">--Choisir un article vidéo--</option>
                            <?php echo $articlesVideo ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">⚠️ Cette action est irréversible !</small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer article -->
                        <input class="btn btn-primary btn-block" type="submit" value="Supprimer l'article vidéo" name="formSupprimerArticleVideo_supprimer">
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