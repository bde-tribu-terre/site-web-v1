<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un journal</h3>
                <hr>
                <form id="formSupprimerJournal" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Journal en question -->
                        <label for="formSupprimerJournal_id">Goodie :</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formSupprimerJournal_id" name="formSupprimerJournal_id">
                            <option value="">--Choisir un journal--</option>
                            <?php echo JOURNAUX ?>
                        </select>
                    </div>
                    <p>⚠️ Cette action est irréversible ! ⚠️</p>
                    <hr>
                    <div class="form-group"> <!-- Supprimer journal -->
                        <input class="btn btn-danger btn-block" type="submit" value="Supprimer le journal" name="formSupprimerJournal_supprimer_submit">
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