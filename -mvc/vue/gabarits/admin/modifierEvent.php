<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Modifier un événement</h3>
                <hr>
                <form id="formModifierEvent" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- ID de l'événement -->
                        <label for="formModifierEvent_id">
                            ID de l'événement
                        </label>
                        <input
                                id="formModifierEvent_id"
                                name="formModifierEvent_id"
                                type="text"
                                class="form-control"
                                readonly
                                value="<?php echo ID ?>"
                                onblur="verifNonVide(this);"
                        >
                    </div>
                    <div class="form-group"> <!-- Titre de l'événement -->
                        <label for="formModifierEvent_titre">
                            Titre de l'événement
                        </label>
                        <input
                                id="formModifierEvent_titre"
                                name="formModifierEvent_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                value="<?php echo TITRE ?>"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 64);"
                        >
                    </div>
                    <div class="form-group"> <!-- Date -->
                        <label for="formModifierEvent_date">
                            Date
                        </label>
                        <input
                                id="formModifierEvent_date"
                                name="formModifierEvent_date"
                                type="date"
                                class="form-control"
                                placeholder="Date"
                                value="<?php echo DATE ?>"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            S'il n'y a pas de petit menu qui s'ouvre, alors saisir une date sous le format "aaaa-mm-jj"
                        </small>
                    </div>
                    <div class="form-group"> <!-- Heure -->
                        <label for="formModifierEvent_heureHeure">
                            Heure
                        </label>
                        <label for="formModifierEvent_heureMinute" style="display: none;">
                            Heure (minutes)
                        </label>
                        <input
                                id="formModifierEvent_heureHeure"
                                name="formModifierEvent_heureHeure"
                                type="number"
                                class="form-control"
                                min="0"
                                max="23"
                                placeholder="Heure"
                                value="<?php echo HEURE ?>"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Heure
                        </small>
                        <input
                                id="formModifierEvent_heureMinute"
                                name="formModifierEvent_heureMinute"
                                type="number"
                                class="form-control"
                                min="0"
                                max="59"
                                placeholder="Minutes"
                                value="<?php echo MINUTE ?>"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Minutes
                        </small>
                    </div>
                    <div class="form-group"> <!-- Lieu -->
                        <label for="formModifierEvent_lieu">
                            Lieu
                        </label>
                        <input
                                id="formModifierEvent_lieu"
                                name="formModifierEvent_lieu"
                                type="text"
                                class="form-control"
                                placeholder="Lieu"
                                value="<?php echo LIEU ?>"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 32);"
                        >
                    </div>
                    <div class="form-group"> <!-- Description de l'événement -->
                        <label for="formModifierEvent_desc">
                            Description de l'événement
                        </label>
                        <textarea
                                id="formModifierEvent_desc"
                                name="formModifierEvent_desc"
                                class="form-control"
                                rows="20"
                                placeholder="Description de l'événement"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 7999);"
                        ><?php echo DESC ?></textarea> <!-- Si linebreak : whitespace superflu. -->
                        <small class="form-text text-muted">
                            Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.
                        </small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Modifier Événement -->
                        <input
                                id="formModifierEvent_modifierEvent_submit"
                                name="formModifierEvent_modifierEvent_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Modifier l'événement"
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
