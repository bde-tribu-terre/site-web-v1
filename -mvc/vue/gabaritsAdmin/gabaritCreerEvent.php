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
                <h3>Ajouter un évent</h3>
                <hr>
                <form id="formCreerEvent" method="post">
                    <div class="form-group"> <!-- Titre de l'évent -->
                        <label for="formCreerEvent_titre">Titre de l'évent</label>
                        <input class="form-control" id="formCreerEvent_titre" type="text" placeholder="Titre" name="formCreerEvent_titre">
                    </div>
                    <div class="form-group"> <!-- Date -->
                        <label for="formCreerEvent_date">Date</label>
                        <input class="form-control" id="formCreerEvent_date" type="date" name="formCreerEvent_date" placeholder="Date">
                        <small class="form-text text-muted">S'il n'y a pas de petit menu qui s'ouvre, alors saisir une date sous le format "aaaa-mm-jj"</small>
                    </div>
                    <div class="form-group"> <!-- Heure -->
                        <label for="formCreerEvent_heureHeure">Heure</label>
                        <input class="form-control" id="formCreerEvent_heureHeure" type="number" min="0" max="23" name="formCreerEvent_heureHeure" placeholder="Heure">
                        <small class="form-text text-muted">Heure</small>
                        <input class="form-control" id="formCreerEvent_heureMinute" type="number" min="0" max="59" name="formCreerEvent_heureMinute" placeholder="Minutes">
                        <small class="form-text text-muted">Minutes</small>
                    </div>
                    <div class="form-group"> <!-- Lieu -->
                        <label for="formCreerEvent_lieu">Lieu</label>
                        <input class="form-control" id="formCreerEvent_lieu" type="text" name="formCreerEvent_lieu" placeholder="Lieu">
                    </div>
                    <div class="form-group"> <!-- Description de l'évent -->
                        <label for="formCreerEvent_desc">Description de l'évent</label>
                        <textarea class="form-control" id="formCreerEvent_desc" placeholder="Description de l'évent" name="formCreerEvent_desc" rows="20"></textarea>
                        <small class="form-text text-muted">Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.</small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter Évent -->
                        <input class="btn btn-danger btn-block" type="submit" value="Ajouter l'évent" name="formCreerEvent_ajouter">
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