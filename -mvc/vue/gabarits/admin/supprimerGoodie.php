<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un goodie</h3>
                <hr>
                <form id="formSupprimerGoodie" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Goodie en question -->
                        <label for="formSupprimerGoodie_id">
                            Goodie
                        </label>
                        <select
                                id="formSupprimerGoodie_id"
                                name="formSupprimerGoodie_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un goodie--</option>
                            <?php echo GOODIES ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">
                        ⚠️ Cette action est irréversible !
                    </small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer goodie -->
                        <input
                                id="formSupprimerGoodie_supprimer_submit"
                                name="formSupprimerGoodie_supprimer_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Supprimer le goodie"
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