<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Modifier un goodie</h3>
                <hr>
                <form id="formModifierGoodie" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Supprimer des images du goodie -->
                        <input class="btn btn-danger" type="submit" value="Supprimer des images du goodie" name="formModifierGoodie_supprimerImages_submit">
                    </div>
                    <hr>
                    <div class="form-group"> <!-- ID du goodie -->
                        <label for="formModifierGoodie_idGoodie">ID du goodie</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formModifierGoodie_idGoodie" type="text" value="<?php echo ID ?>" name="formModifierGoodie_idGoodie" readonly>
                    </div>
                    <div class="form-group"> <!-- Titre du goodie -->
                        <label for="formModifierGoodie_titreGoodie">Titre du goodie</label>
                        <input onblur="verifNonVide(this);" oninput="garderMoins(this, 64);" class="form-control" id="formModifierGoodie_titreGoodie" type="text" value="<?php echo TITRE ?>" placeholder="Titre" name="formModifierGoodie_titreGoodie">
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formModifierGoodie_categorie">Catégorie</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formModifierGoodie_categorie" name="formModifierGoodie_categorie">
                            <option value="0"<?php if (CATEGORIE == 0) { echo ' selected'; } ?>>Caché</option>
                            <option value="1"<?php if (CATEGORIE == 1) { echo ' selected'; } ?>>Disponible</option>
                            <option value="2"<?php if (CATEGORIE == 2) { echo ' selected'; } ?>>Bientôt disponible</option>
                            <option value="3"<?php if (CATEGORIE == 3) { echo ' selected'; } ?>>En rupture de stock</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Prix adhérent -->
                        <label for="formModifierGoodie_prixADEuro">Prix adhérent</label>
                        <label for="formModifierGoodie_prixADCentimes" style="display: none;">Prix adhérent (centimes)</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formModifierGoodie_prixADEuro" type="number" value="<?php echo PRIX_AD_EURO ?>" min="0" name="formModifierGoodie_prixADEuro" placeholder="Euros">
                        <small class="form-text text-muted">Euros</small>
                        <input onblur="verifNonVide(this);" class="form-control" id="formModifierGoodie_prixADCentimes" type="number" value="<?php echo PRIX_AD_CENTIMES ?>" min="0" max="99" name="formModifierGoodie_prixADCentimes" placeholder="Centimes">
                        <small class="form-text text-muted">Centimes</small>
                    </div>
                    <div class="form-group"> <!-- Prix non-adhérent -->
                        <label for="formModifierGoodie_prixNADEuro">Prix non-adhérent</label>
                        <label for="formModifierGoodie_prixNADtCentimes">Prix non-adhérent (centimes)</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formModifierGoodie_prixNADEuro" type="number" value="<?php echo PRIX_NAD_EURO ?>" min="0" name="formModifierGoodie_prixNADEuro" placeholder="Euros">
                        <small class="form-text text-muted">Euros</small>
                        <input onblur="verifNonVide(this);" class="form-control" id="formModifierGoodie_prixNADCentimes" type="number" value="<?php echo PRIX_NAD_CENTIMES ?>" min="0" max="99" name="formModifierGoodie_prixNADCentimes" placeholder="Centimes">
                        <small class="form-text text-muted">Centimes</small>
                    </div>
                    <div class="form-group"> <!-- Description du goodie -->
                        <label for="formModifierGoodie_descGoodie">Description du goodie</label>
                        <textarea onblur="verifNonVide(this);" oninput="garderMoins(this, 7999);" class="form-control" id="formModifierGoodie_descGoodie" placeholder="Description du goodie" name="formModifierGoodie_descGoodie" rows="20"><?php echo DESC ?></textarea>
                        <small class="form-text text-muted">Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.</small>
                    </div>
                    <small class="form-text text-muted">⚠️ Pour modifier la miniature il faut recréer le goodie. Désolé !</small>
                    <hr>
                    <div class="form-group"> <!-- Modifier Goodie -->
                        <input class="btn btn-danger btn-block" type="submit" value="Modifier le goodie" name="formModifierGoodie_modifierGoodie_submit">
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
                        <input class="btn btn-danger btn-block" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu_submit">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>