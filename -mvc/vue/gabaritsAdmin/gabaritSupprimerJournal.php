<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (!empty($messageRetour)) {
                echo
                    '<div class="well">' .
                    '<h3>Message : </h3>' .
                    '<p><strong>' . $messageRetour . '</strong></p>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un journal</h3>
                <hr>
                <form id="formSupprimerJournal" method="post">
                    <div class="form-group"> <!-- Journal en question -->
                        <label for="formSupprimerJournal_idJournal">Goodie :</label>
                        <select class="form-control" id="formSupprimerJournal_idJournal" name="formSupprimerJournal_idJournal">
                            <option value="">--Choisir un journal--</option>
                            <?php echo $journaux ?>
                        </select>
                    </div>
                    <p>⚠️ Cette action est irréversible ! ⚠️</p>
                    <hr>
                    <div class="form-group"> <!-- Supprimer journal -->
                        <input class="btn btn-primary" type="submit" value="Supprimer le journal" name="formSupprimerJournal_supprimer">
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
                        <input class="btn btn-primary" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>