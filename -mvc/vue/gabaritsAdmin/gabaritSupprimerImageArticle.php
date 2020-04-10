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
                <h3>Supprimer des images d'un goodie</h3>
                <hr>
                <form id="formSupprimerImageArticle" method="post">
                    <div class="form-group"> <!-- ID du goodie -->
                        <label for="formSupprimerImageArticle_idArticle">ID de l'article</label>
                        <input class="form-control" id="formSupprimerImageArticle_idArticle" type="text" value="<?php echo $idArticle ?>" name="formSupprimerImageArticle_idArticle" readonly>
                    </div>
                    <?php echo $images ?>
                    <hr>
                    <div class="form-group"> <!-- Supprimer les images -->
                        <input class="btn btn-primary" type="submit" value="Supprimer les images" name="formSupprimerImageArticle_supprimer">
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