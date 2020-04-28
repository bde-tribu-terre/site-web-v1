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
                <h3>Choisir un article vidéo à modifier</h3>
                <hr>
                <form id="formChoisirArticleVideo" method="post">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formChoisirArticleVideo_idArticle">Article vidéo</label>
                        <select class="form-control" id="formChoisirArticleVideo_idArticle" name="formChoisirArticleVideo_idArticle">
                            <option value="">--Choisir un article vidéo--</option>
                            <?php echo ARTICLES_VIDEO ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Article Vidéo -->
                        <input class="btn btn-danger btn-block" type="submit" value="Choisir l'article" name="formChoisirArticleVideo_choisir">
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