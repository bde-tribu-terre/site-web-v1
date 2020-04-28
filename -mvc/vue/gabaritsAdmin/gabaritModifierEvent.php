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
                <h3>Modifier un évent</h3>
                <hr>
                <form id="formModifierEvent" method="post">
                    <div class="form-group"> <!-- ID de l'évent -->
                        <label for="formModifierEvent_idEvent">ID de l'évent</label>
                        <input class="form-control" id="formModifierEvent_idEvent" type="text" value="<?php echo ID ?>" name="formModifierEvent_idEvent" readonly>
                    </div>
                    <div class="form-group"> <!-- Titre de l'évent -->
                        <label for="formModifierEvent_titre">Titre de l'évent</label>
                        <input class="form-control" id="formModifierEvent_titre" type="text" value="<?php echo TITRE ?>" placeholder="Titre" name="formModifierEvent_titre">
                    </div>
                    <div class="form-group"> <!-- Date -->
                        <label for="formModifierEvent_date">Date</label>
                        <input class="form-control" id="formModifierEvent_date" type="date" value="<?php echo DATE ?>" name="formModifierEvent_date" placeholder="Date">
                        <small class="form-text text-muted">S'il n'y a pas de petit menu qui s'ouvre, alors saisir une date sous le format "aaaa-mm-jj"</small>
                    </div>
                    <div class="form-group"> <!-- Heure -->
                        <label for="formModifierEvent_heureHeure">Heure</label>
                        <input class="form-control" id="formModifierEvent_heureHeure" type="number" value="<?php echo HEURE ?>" min="0" max="23" name="formModifierEvent_heureHeure" placeholder="Heure">
                        <small class="form-text text-muted">Heure</small>
                        <input class="form-control" id="formModifierEvent_heureMinute" type="number" value="<?php echo MINUTE ?>" min="0" max="59" name="formModifierEvent_heureMinute" placeholder="Minutes">
                        <small class="form-text text-muted">Minutes</small>
                    </div>
                    <div class="form-group"> <!-- Lieu -->
                        <label for="formModifierEvent_lieu">Lieu</label>
                        <input class="form-control" id="formModifierEvent_lieu" type="text" value="<?php echo LIEU ?>" name="formModifierEvent_lieu" placeholder="Lieu">
                    </div>
                    <div class="form-group"> <!-- Description de l'évent -->
                        <label for="formModifierEvent_desc">Description de l'évent</label>
                        <textarea class="form-control" id="formModifierEvent_desc" placeholder="Description de l'évent" name="formModifierEvent_desc" rows="20"><?php echo DESC ?></textarea>
                        <small class="form-text text-muted">Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.</small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Modifier Évent -->
                        <input class="btn btn-danger btn-block" type="submit" value="Modifier l'évent" name="formModifierEvent_modifierEvent">
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