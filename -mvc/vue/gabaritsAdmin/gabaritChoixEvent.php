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
                <h3>Choisir un évent à modifier</h3>
                <hr>
                <form id="formChoisirEvent" method="post">
                    <div class="form-group"> <!-- Évent en question -->
                        <label for="formChoisirEvent_idEvent">Évent</label>
                        <select class="form-control" id="formChoisirEvent_idEvent" name="formChoisirEvent_idEvent">
                            <option value="">--Choisir un évent--</option>
                            <?php echo $events ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Choisir Évent -->
                        <input class="btn btn-danger btn-block" type="submit" value="Choisir l'évent" name="formChoisirEvent_choisir">
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