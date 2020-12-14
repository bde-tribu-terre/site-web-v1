<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un lien</h3>
                <hr>
                <form id="formAjouterLienPratique" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Titre du lien -->
                        <label for="formAjouterLienPratique_titre">
                            Titre du lien
                        </label>
                        <input
                                id="formAjouterLienPratique_titre"
                                name="formAjouterLienPratique_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 128);"
                        >
                    </div>
                    <div class="form-group"> <!-- URL du lien -->
                        <label for="formAjouterLienPratique_url">
                            URL du lien
                        </label>
                        <input
                                id="formAjouterLienPratique_url"
                                name="formAjouterLienPratique_url"
                                type="text"
                                class="form-control"
                                placeholder="URL"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 1024);"
                        >
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter la catégorie -->
                        <input
                                id="formAjouterLienPratique_ajouter_submit"
                                name="formAjouterLienPratique_ajouter_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Ajouter le lien"
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
