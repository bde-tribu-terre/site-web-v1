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
                <h3>Supprimer un article</h3>
                <hr>
                <form id="formSupprimerArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Article en question -->
                        <label for="formSupprimerArticle_idArticle">Article</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formSupprimerArticle_idArticle" name="formSupprimerArticle_idArticle">
                            <option value="">--Choisir un article--</option>
                            <?php echo ARTICLES ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">⚠️ Cette action est irréversible !</small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer article -->
                        <input class="btn btn-danger btn-block" type="submit" value="Supprimer l'article" name="formSupprimerArticle_supprimer">
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