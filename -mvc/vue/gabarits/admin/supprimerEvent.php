<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un évent</h3>
                <hr>
                <form id="formSupprimerEvent" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Évent en question -->
                        <label for="formSupprimerEvent_id">
                            Évent
                        </label>
                        <select
                                id="formSupprimerEvent_id"
                                name="formSupprimerEvent_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un évent--</option>
                            <?php echo EVENTS ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">
                        ⚠️ Cette action est irréversible !
                    </small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer évent -->
                        <input
                                id="formSupprimerEvent_supprimer_submit"
                                name="formSupprimerEvent_supprimer_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Supprimer l'évent"
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
