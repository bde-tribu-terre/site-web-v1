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
                <h3>Ajouter une catégorie d'article</h3>
                <hr>
                <form id="formAjouterCategorieArticle" method="post">
                    <div class="form-group"> <!-- Titre de la catégorie -->
                        <label for="formAjouterCategorieArticle_titre">Titre de la catégorie</label>
                        <input class="form-control" id="formAjouterCategorieArticle_titre" type="text" placeholder="Titre" name="formAjouterCategorieArticle_titre">
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter la catégorie -->
                        <input class="btn btn-danger btn-block" type="submit" value="Ajouter la catégorie" name="formAjouterCategorieArticle_ajouter">
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