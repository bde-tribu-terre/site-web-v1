<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter une catégorie d'article</h3>
                <hr>
                <form id="formAjouterCategorieArticle" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Titre de la catégorie -->
                        <label for="formAjouterCategorieArticle_titre">
                            Titre de la catégorie
                        </label>
                        <input
                                id="formAjouterCategorieArticle_titre"
                                name="formAjouterCategorieArticle_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 128);"
                        >
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter la catégorie -->
                        <input
                                id="formAjouterCategorieArticle_ajouter_submit"
                                name="formAjouterCategorieArticle_ajouter_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Ajouter la catégorie"
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