<div class="container text-center">
    <h3>Goodies</h3>
    <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#recherche" aria-expanded="<?php echo RECHERCHE_EN_COURS ?>">
        Options de recherche...
    </button>
    <div class="collapse<?php echo RECHERCHE_EN_COURS == 'true' ? ' in' : ''; ?>" id="recherche" aria-expanded="<?php echo RECHERCHE_EN_COURS ?>">
        <div class="card card-body">
            <form method="get" onsubmit="check()">
                <script>
                    function check() {
                        if(document.getElementById("disponible").checked) {
                            document.getElementById('disponibleHidden').disabled = true;
                        }
                        if(document.getElementById("bientot").checked) {
                            document.getElementById('bientotHidden').disabled = true;
                        }
                        if(document.getElementById("rupture").checked) {
                            document.getElementById('ruptureHidden').disabled = true;
                        }
                    }
                </script>
                <label for="tri">Trier par :</label>
                <select id="tri" name="tri">
                    <option value=""<?php if (RECHERCHE_EN_COURS == 'true' && TRI == '') { echo ' selected'; } ?>>--Choisir--</option>
                    <option value="nom"<?php if (RECHERCHE_EN_COURS == 'true' && TRI == 'nom') { echo ' selected'; } ?>>Nom</option>
                    <option value="prixAD"<?php if (RECHERCHE_EN_COURS == 'true' && TRI == 'prixAD') { echo ' selected'; } ?>>Prix adhérent (croissant)</option>
                    <option value="prixADD"<?php if (RECHERCHE_EN_COURS == 'true' && TRI == 'prixADD') { echo ' selected'; } ?>>Prix adhérent (décroissant)</option>
                    <option value="prixNAD"<?php if (RECHERCHE_EN_COURS == 'true' && TRI == 'prixNAD') { echo ' selected'; } ?>>Pris non-adhérent (croissant)</option>
                    <option value="prixNADD"<?php if (RECHERCHE_EN_COURS == 'true' && TRI == 'prixNADD') { echo ' selected'; } ?>>Pris non-adhérent (décroissant)</option>
                </select>
                &nbsp;
                <label for="disponible">Disponible</label>
                <input id="disponible" name="disponible" type="checkbox" value="on"<?php echo CHECKED_DISPONIBLE ?>>
                <input id="disponibleHidden" name='disponible' type='hidden' value='off'>
                &nbsp;
                <label for="bientot">Bientôt disponible</label>
                <input id="bientot" name="bientot" type="checkbox" value="on"<?php echo CHECKED_BIENTOT ?>>
                <input id="bientotHidden" name='bientot' type='hidden' value='off'>
                &nbsp;
                <label for="rupture">En rupture de stock</label>
                <input id="rupture" name="rupture" type="checkbox" value="on"<?php echo CHECKED_RUPTURE ?>>
                <input id="ruptureHidden" name='rupture' type='hidden' value='off'>
                &nbsp;
                <input type="submit" value="Rechercher">
            </form>
        </div>
    </div>
    <hr>
    <?php echo GOODIES ?>
</div><br>