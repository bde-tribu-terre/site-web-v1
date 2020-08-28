<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un lien</h3>
                <hr>
                <form id="formSupprimerLienPratique" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Lien en question -->
                        <label for="formSupprimerLienPratique_id">
                            Lien
                        </label>
                        <select
                                id="formSupprimerLienPratique_id"
                                name="formSupprimerLienPratique_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un lien--</option>
                            <?php echo LIENS_PRATIQUES ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">
                        ⚠️ Cette action est irréversible !
                    </small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer le lien -->
                        <input
                                id="formSupprimerLienPratique_supprimer_submit"
                                name="formSupprimerLienPratique_supprimer_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Supprimer le lien"
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