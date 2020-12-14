<div class="container text-center">
    <h3>Trouver une salle</h3>
    <hr>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form id="formConnexion" method="get" onsubmit="return verifForm(this);">
                <p> <!-- Nom Salle -->
                    <label style="display: none" for="nom">Nom de la salle</label>
                    <!-- En display none JS prends les retours à la ligne avant et après du innerText -->
                    <input
                            id="nom"
                            name="nom"
                            type="text"
                            class="form-control"
                            placeholder="Saisir le nom de la salle"
                            onblur="verifNonVide(this);"
                            oninput="garderMoins(this, 64);"
                    >
                    <small class="form-text text-muted">
                        Telle qu'indiquée sur l'emploi du temps.
                        Ex. : "S110", "Amphi. 3 Sciences", "NG02", "Salle 157".
                    </small>
                </p>
                <hr>
                <p> <!-- Rechercher -->
                    <input
                            type="submit"
                            class="btn btn-var btn-block"
                            value="Lancer la recherche"
                    >
                </p>
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div>
