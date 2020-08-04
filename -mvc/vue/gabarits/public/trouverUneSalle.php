<div class="container text-center">
    <h3>Trouver une salle</h3>
    <hr>
    <div class="row" <?php echo NOMBRE == 0 ? 'style="display: none;"' : '' ?>>
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            echo NOMBRE > 1 ?
                '<h4>' . NOMBRE . 'salles correspondantes ont été trouvées.</h4>' :
                '<h4>Une salle correspondante a été trouvée.</h4>';
            echo SALLES
            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <?php
    echo NOMBRE != 0 ?
        '<hr><h3>Lancer une nouvelle recherche</h3>' :
        ''
    ?>
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form id="formConnexion" method="get" onsubmit="return verifForm(this);">
                <p> <!-- Identifiant -->
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
                </p>
                <hr>
                <p> <!-- Se connecter -->
                    <input
                            type="submit"
                            class="btn btn-danger btn-block"
                            value="Lancer la recherche"
                    >
                </p>
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div>
</div><br>