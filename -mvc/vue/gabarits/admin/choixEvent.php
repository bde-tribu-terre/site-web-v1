<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Choisir un événement à modifier</h3>
                <hr>
                <form id="formChoisirEvent" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Événement en question -->
                        <label for="formChoisirEvent_id">
                            Événement
                        </label>
                        <select
                                id="formChoisirEvent_id"
                                name="formChoisirEvent_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un événement--</option>
                            <?php echo EVENTS ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Événement -->
                        <input
                                id="formChoisirEvent_choisir_submit"
                                name="formChoisirEvent_choisir_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Choisir l'événement"
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
