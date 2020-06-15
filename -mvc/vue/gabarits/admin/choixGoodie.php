<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Choisir un goodie à modifier</h3>
                <hr>
                <form id="formChoisirGoodie" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Goodie en question -->
                        <label for="formChoisirGoodie_idGoodie">Goodie</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formChoisirGoodie_idGoodie" name="formChoisirGoodie_idGoodie">
                            <option value="">--Choisir un goodie--</option>
                            <?php echo GOODIES ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Goodie -->
                        <input class="btn btn-danger btn-block" type="submit" value="Choisir le goodie" name="formChoisirGoodie_choisir_submit">
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