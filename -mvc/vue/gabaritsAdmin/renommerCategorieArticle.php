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
                <h3>Renommer une catégorie d'articles</h3>
                <hr>
                <form id="formRenommerCategorieArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formRenommerCategorieArticle_idCategorieArticle">Catégorie à renommer</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formRenommerCategorieArticle_idCategorieArticle" name="formRenommerCategorieArticle_idCategorieArticle">
                            <option value="">--Choisir--</option>
                            <?php echo CATEGORIES ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Nouveau titre de la catégorie -->
                        <label for="formRenommerCategorieArticle_titre">Nouveau titre de la catégorie</label>
                        <input onblur="verifNonVide(this);" oninput="garderMoins(input, 128);" class="form-control" id="formRenommerCategorieArticle_titre" type="text" placeholder="Titre" name="formRenommerCategorieArticle_titre">
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Supprimer évent -->
                        <input class="btn btn-danger btn-block" type="submit" value="Renommer la catégorie" name="formRenommerCategorieArticle_renommer">
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