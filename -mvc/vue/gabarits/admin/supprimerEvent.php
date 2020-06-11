<div class="container text-center">
    <?php require_once CHEMIN_VERS_MESSAGES ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un évent</h3>
                <hr>
                <form id="formSupprimerEvent" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Évent en question -->
                        <label for="formSupprimerEvent_id">Évent</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formSupprimerEvent_id" name="formSupprimerEvent_id">
                            <option value="">--Choisir un évent--</option>
                            <?php echo EVENTS ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">⚠️ Cette action est irréversible !</small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer évent -->
                        <input class="btn btn-danger btn-block" type="submit" value="Supprimer l'évent" name="formSupprimerEvent_supprimer">
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