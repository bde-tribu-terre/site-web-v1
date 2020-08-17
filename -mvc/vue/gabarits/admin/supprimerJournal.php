<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un journal</h3>
                <hr>
                <form id="formSupprimerJournal" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Journal en question -->
                        <label for="formSupprimerJournal_id">
                            Journal
                        </label>
                        <select
                                id="formSupprimerJournal_id"
                                name="formSupprimerJournal_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un journal--</option>
                            <?php echo JOURNAUX ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">
                        ⚠️ Cette action est irréversible !
                    </small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer journal -->
                        <input
                                id="formSupprimerJournal_supprimer_submit"
                                name="formSupprimerJournal_supprimer_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Supprimer le journal"
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