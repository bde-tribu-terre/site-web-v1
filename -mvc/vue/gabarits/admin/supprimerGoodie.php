<div class="container text-center">
    <?php require_once CHEMIN_VERS_MESSAGES ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un goodie</h3>
                <hr>
                <form id="formSupprimerGoodie" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Goodie en question -->
                        <label for="formSupprimerGoodie_id">Goodie</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formSupprimerGoodie_id" name="formSupprimerGoodie_id">
                            <option value="">--Choisir un goodie--</option>
                            <?php echo GOODIES ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">⚠️ Cette action est irréversible !</small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer goodie -->
                        <input class="btn btn-danger btn-block" type="submit" value="Supprimer le goodie" name="formSupprimerGoodie_supprimer">
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