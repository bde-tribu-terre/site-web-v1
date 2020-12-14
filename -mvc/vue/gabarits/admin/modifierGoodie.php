<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Modifier un goodie</h3>
                <hr>
                <form id="formModifierGoodie" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Supprimer des images du goodie -->
                        <input
                                id="formModifierGoodie_supprimerImages_submit"
                                name="formModifierGoodie_supprimerImages_submit"
                                type="submit"
                                class="btn btn-var"
                                value="Supprimer des images du goodie"
                        >
                    </div>
                    <hr>
                    <div class="form-group"> <!-- ID du goodie -->
                        <label for="formModifierGoodie_id">
                            ID du goodie
                        </label>
                        <input
                                id="formModifierGoodie_id"
                                name="formModifierGoodie_id"
                                type="text" value="<?php echo ID ?>"
                                class="form-control"
                                readonly
                                onblur="verifNonVide(this);"
                        >
                    </div>
                    <div class="form-group"> <!-- Titre du goodie -->
                        <label for="formModifierGoodie_titre">
                            Titre du goodie
                        </label>
                        <input
                                id="formModifierGoodie_titre"
                                name="formModifierGoodie_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                value="<?php echo TITRE ?>"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 64);"
                        >
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formModifierGoodie_categorie">
                            Catégorie
                        </label>
                        <select
                                id="formModifierGoodie_categorie"
                                name="formModifierGoodie_categorie"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="0"<?php if (CATEGORIE == 0) { echo ' selected'; } ?>>
                                Caché
                            </option>
                            <option value="1"<?php if (CATEGORIE == 1) { echo ' selected'; } ?>>
                                Disponible
                            </option>
                            <option value="2"<?php if (CATEGORIE == 2) { echo ' selected'; } ?>>
                                Bientôt disponible
                            </option>
                            <option value="3"<?php if (CATEGORIE == 3) { echo ' selected'; } ?>>
                                En rupture de stock
                            </option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Prix adhérent -->
                        <label for="formModifierGoodie_prixADEuro">
                            Prix adhérent
                        </label>
                        <label for="formModifierGoodie_prixADCentimes" style="display: none;">
                            Prix adhérent (centimes)
                        </label>
                        <input
                                id="formModifierGoodie_prixADEuro"
                                name="formModifierGoodie_prixADEuro"
                                type="number"
                                class="form-control"
                                min="0"
                                placeholder="Euros"
                                value="<?php echo PRIX_AD_EURO ?>"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Euros
                        </small>
                        <input
                                id="formModifierGoodie_prixADCentimes"
                                name="formModifierGoodie_prixADCentimes"
                                type="number"
                                class="form-control"
                                min="0"
                                max="99"
                                placeholder="Centimes"
                                value="<?php echo PRIX_AD_CENTIMES ?>"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Centimes
                        </small>
                    </div>
                    <div class="form-group"> <!-- Prix non-adhérent -->
                        <label for="formModifierGoodie_prixNADEuro">
                            Prix non-adhérent
                        </label>
                        <label for="formModifierGoodie_prixNADCentimes">
                            Prix non-adhérent (centimes)
                        </label>
                        <input
                                id="formModifierGoodie_prixNADEuro"
                                name="formModifierGoodie_prixNADEuro"
                                type="number"
                                class="form-control"
                                min="0"
                                placeholder="Euros"
                                value="<?php echo PRIX_NAD_EURO ?>"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Euros
                        </small>
                        <input
                                id="formModifierGoodie_prixNADCentimes"
                                name="formModifierGoodie_prixNADCentimes"
                                type="number"
                                class="form-control"
                                min="0"
                                max="99"
                                placeholder="Centimes"
                                value="<?php echo PRIX_NAD_CENTIMES ?>"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Centimes
                        </small>
                    </div>
                    <div class="form-group"> <!-- Description du goodie -->
                        <label for="formModifierGoodie_desc">
                            Description du goodie
                        </label>
                        <textarea
                                id="formModifierGoodie_desc"
                                name="formModifierGoodie_desc"
                                class="form-control"
                                rows="20"
                                placeholder="Description du goodie"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 7999);"
                        ><?php echo DESC ?></textarea>
                        <small class="form-text text-muted">
                            Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.
                        </small>
                    </div>
                    <small class="form-text text-muted">
                        ⚠️ Pour modifier la miniature il faut recréer le goodie. Désolé !
                    </small>
                    <hr>
                    <div class="form-group"> <!-- Modifier Goodie -->
                        <input
                                id="formModifierGoodie_modifierGoodie_submit"
                                name="formModifierGoodie_modifierGoodie_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Modifier le goodie"
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
