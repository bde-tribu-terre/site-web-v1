<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (!empty(MESSAGE_RETOUR)) {
                echo
                    '<div class="well">' .
                    '<h3>Message : </h3>' .
                    '<p><strong>' . MESSAGE_RETOUR . '</strong></p>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Supprimer un évent</h3>
                <hr>
                <form id="formSupprimerEvent" method="post">
                    <div class="form-group"> <!-- Évent en question -->
                        <label for="formSupprimerEvent_idEvent">Évent</label>
                        <select class="form-control" id="formSupprimerEvent_idEvent" name="formSupprimerEvent_idEvent">
                            <option value="">--Choisir un évent--</option>
                            <?php echo EVENTS ?>
                        </select>
                    </div>
                    <small class="form-text text-muted">⚠️ Cette action est irréversible !</small>
                    <hr>
                    <div class="form-group"> <!-- Supprimer évent -->
                        <input class="btn btn-danger btn-block" type="submit" value="Supprimer l'évent" name="formSupprimerEvent_supprimer">
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