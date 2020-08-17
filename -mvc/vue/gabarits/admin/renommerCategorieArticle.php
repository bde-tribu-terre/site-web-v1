<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Renommer une catégorie d'articles</h3>
                <hr>
                <form id="formRenommerCategorieArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formRenommerCategorieArticle_id">
                            Catégorie à renommer
                        </label>
                        <select
                                id="formRenommerCategorieArticle_id"
                                name="formRenommerCategorieArticle_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir--</option>
                            <?php echo CATEGORIES ?>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Nouveau titre de la catégorie -->
                        <label for="formRenommerCategorieArticle_titre">
                            Nouveau titre de la catégorie
                        </label>
                        <input
                                id="formRenommerCategorieArticle_titre"
                                name="formRenommerCategorieArticle_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 128);"
                        >
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Supprimer évent -->
                        <input
                                id="formRenommerCategorieArticle_renommer_submit"
                                name="formRenommerCategorieArticle_renommer_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Renommer la catégorie"
                        >
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
                        <input
                                id="formRetourMenu_retourMenu_submit"
                                name="formRetourMenu_retourMenu_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Retour au menu"
                        >
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>