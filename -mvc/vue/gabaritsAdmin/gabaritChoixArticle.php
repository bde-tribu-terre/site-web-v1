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
                <h3>Choisir un article à modifier</h3>
                <hr>
                <form id="formChoisirArticle" method="post">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formChoisirArticle_idArticle">Article</label>
                        <select class="form-control" id="formChoisirArticle_idArticle" name="formChoisirArticle_idArticle">
                            <option value="">--Choisir un article--</option>
                            <?php echo $articles ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Article -->
                        <input class="btn btn-primary btn-block" type="submit" value="Choisir l'article" name="formChoisirArticle_choisir">
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