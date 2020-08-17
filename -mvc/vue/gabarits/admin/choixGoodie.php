<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Choisir un goodie à modifier</h3>
                <hr>
                <form id="formChoisirGoodie" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Goodie en question -->
                        <label for="formChoisirGoodie_id">
                            Goodie
                        </label>
                        <select
                                id="formChoisirGoodie_id"
                                name="formChoisirGoodie_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un goodie--</option>
                            <?php echo GOODIES ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Goodie -->
                        <input
                                id="formChoisirGoodie_choisir_submit"
                                name="formChoisirGoodie_choisir_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Choisir le goodie"
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