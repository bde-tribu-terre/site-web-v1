<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un évent</h3>
                <hr>
                <form id="formCreerEvent" method="post" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Titre de l'évent -->
                        <label for="formCreerEvent_titre">
                            Titre de l'évent
                        </label>
                        <input
                                id="formCreerEvent_titre"
                                name="formCreerEvent_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 64);"
                        >
                    </div>
                    <div class="form-group"> <!-- Date -->
                        <label for="formCreerEvent_date">
                            Date
                        </label>
                        <input
                                id="formCreerEvent_date"
                                name="formCreerEvent_date"
                                type="date"
                                class="form-control"
                                placeholder="Date"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            S'il n'y a pas de petit menu qui s'ouvre, alors saisir une date sous le format "aaaa-mm-jj"
                        </small>
                    </div>
                    <div class="form-group"> <!-- Heure -->
                        <label for="formCreerEvent_heureHeure">
                            Heure
                        </label>
                        <label for="formCreerEvent_heureMinute" style="display: none;">
                            Heure (minutes)
                        </label>
                        <input
                                id="formCreerEvent_heureHeure"
                                name="formCreerEvent_heureHeure"
                                type="number"
                                class="form-control"
                                placeholder="Heure"
                                min="0"
                                max="23"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Heure
                        </small>
                        <input
                                onblur="verifNonVide(this);"
                                class="form-control"
                                id="formCreerEvent_heureMinute"
                                type="number"
                                min="0"
                                max="59"
                                name="formCreerEvent_heureMinute"
                                placeholder="Minutes"
                        >
                        <small class="form-text text-muted">
                            Minutes
                        </small>
                    </div>
                    <div class="form-group"> <!-- Lieu -->
                        <label for="formCreerEvent_lieu">
                            Lieu
                        </label>
                        <input
                                id="formCreerEvent_lieu"
                                name="formCreerEvent_lieu"
                                type="text"
                                class="form-control"
                                placeholder="Lieu"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 32);"
                        >
                    </div>
                    <div class="form-group"> <!-- Description de l'évent -->
                        <label for="formCreerEvent_desc">
                            Description de l'évent
                        </label>
                        <textarea
                                id="formCreerEvent_desc"
                                name="formCreerEvent_desc"
                                class="form-control"
                                placeholder="Description de l'évent"
                                rows="20"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 7999);"
                        ></textarea>
                        <small class="form-text text-muted">
                            Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.
                        </small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter Évent -->
                        <input
                                id="formCreerEvent_ajouter_submit"
                                name="formCreerEvent_ajouter_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Ajouter l'évent"
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
