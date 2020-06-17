<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un goodie</h3>
                <hr>
                <form
                        id="formAjouterGoodie"
                        method="post"
                        enctype="multipart/form-data"
                        onsubmit="return verifForm(this);"
                >
                    <div class="form-group"> <!-- Titre du goodie -->
                        <label for="formAjouterGoodie_titre">
                            Titre du goodie
                        </label>
                        <input
                                id="formAjouterGoodie_titre"
                                name="formAjouterGoodie_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 64);"
                        >
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formAjouterGoodie_categorie">
                            Catégorie
                        </label>
                        <select
                                id="formAjouterGoodie_categorie"
                                name="formAjouterGoodie_categorie"
                                class="form-control"
                                onblur="verifNonMoins1(this);"
                        >
                            <option value="-1">--Choisir--</option>
                            <option value="0">Caché</option>
                            <option value="1">Disponible</option>
                            <option value="2">Bientôt disponible</option>
                            <option value="3">En rupture de stock</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Prix adhérent -->
                        <label for="formAjouterGoodie_prixADEuro">
                            Prix adhérent
                        </label>
                        <label for="formAjouterGoodie_prixADCentimes" style="display: none;">
                            Prix adhérent (centimes)
                        </label>
                        <input
                                id="formAjouterGoodie_prixADEuro"
                                name="formAjouterGoodie_prixADEuro"
                                type="number"
                                class="form-control"
                                min="0"
                                placeholder="Euros"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Euros
                        </small>
                        <input
                                id="formAjouterGoodie_prixADCentimes"
                                name="formAjouterGoodie_prixADCentimes"
                                type="number"
                                class="form-control"
                                min="0"
                                max="99"
                                placeholder="Centimes"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Centimes
                        </small>
                    </div>
                    <div class="form-group"> <!-- Prix non-adhérent -->
                        <label for="formAjouterGoodie_prixNADEuro">
                            Prix non-adhérent
                        </label>
                        <label for="formAjouterGoodie_prixNADCentimes" style="display: none;">
                            Prix adhérent (centimes)
                        </label>
                        <input
                                id="formAjouterGoodie_prixNADEuro"
                                name="formAjouterGoodie_prixNADEuro"
                                type="number"
                                class="form-control"
                                min="0"
                                placeholder="Euros"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Euros
                        </small>
                        <input
                                id="formAjouterGoodie_prixNADCentimes"
                                name="formAjouterGoodie_prixNADCentimes"
                                type="number"
                                class="form-control"
                                min="0"
                                max="99"
                                placeholder="Centimes"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Centimes
                        </small>
                    </div>
                    <div class="form-group"> <!-- Description du goodie -->
                        <label for="formAjouterGoodie_desc">
                            Description du goodie
                        </label>
                        <textarea
                                id="formAjouterGoodie_desc"
                                name="formAjouterGoodie_desc"
                                class="form-control"
                                rows="20"
                                placeholder="Description du goodie"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 7999);"
                        ></textarea>
                        <small class="form-text text-muted">
                            Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.
                        </small>
                    </div>
                    <div class="form-group"> <!-- Miniature -->
                        <label for="formAjouterGoodie_miniature">
                            Sélectionner la miniature
                        </label>
                        <input
                                id="formAjouterGoodie_miniature"
                                name="formAjouterGoodie_miniature"
                                type="file"
                                class="form-control"
                                accept="image/*"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            ⚠️ Format : 4:3, pour éviter que ça nique la mise en page.<br>
                            🙏 Taille : 960px*720px.
                        </small>
                    </div>
                    <small class="form-text text-muted">
                        Pour ajouter les images qui seront affichées sur la page du goodie, il faut ajouter le goodie,
                        puis retourner sur le menu admin, et aller dans "ajouter une image à un goodie".
                    </small>
                    <hr>
                    <div class="form-group"> <!-- Ajouter Goodie -->
                        <input
                                id="formAjouterGoodie_ajouterGoodie_submit"
                                name="formAjouterGoodie_ajouterGoodie_submit"
                                type="submit"
                                class="btn btn-danger btn-block"
                                value="Ajouter le goodie"
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
                                class="btn btn-danger btn-block"
                                value="Retour au menu"
                        >
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>