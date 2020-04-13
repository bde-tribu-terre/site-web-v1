<div class="container text-center">
    <h3>Goodies</h3>
    <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#recherche" aria-expanded="<?php echo $rechercheEnCoursStr ?>">
        Options de recherche...
    </button>
    <div class="collapse<?php if ($rechercheEnCours) { echo ' in'; } ?>" id="recherche" aria-expanded="<?php echo $rechercheEnCoursStr ?>">
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
                    <option value=""<?php if ($rechercheEnCours && $tri == '') { echo ' selected'; } ?>>--Choisir--</option>
                    <option value="nom"<?php if ($rechercheEnCours && $tri == 'nom') { echo ' selected'; } ?>>Nom</option>
                    <option value="prixAD"<?php if ($rechercheEnCours && $tri == 'prixAD') { echo ' selected'; } ?>>Prix adhérent (croissant)</option>
                    <option value="prixADD"<?php if ($rechercheEnCours && $tri == 'prixADD') { echo ' selected'; } ?>>Prix adhérent (décroissant)</option>
                    <option value="prixNAD"<?php if ($rechercheEnCours && $tri == 'prixNAD') { echo ' selected'; } ?>>Pris non-adhérent (croissant)</option>
                    <option value="prixNADD"<?php if ($rechercheEnCours && $tri == 'prixNADD') { echo ' selected'; } ?>>Pris non-adhérent (décroissant)</option>
                </select>
                &nbsp;
                <label for="disponible">Disponible</label>
                <input id="disponible" name="disponible" type="checkbox" value="on"<?php echo $checkedDisponible ?>>
                <input id="disponibleHidden" name='disponible' type='hidden' value='off'>
                &nbsp;
                <label for="bientot">Bientôt disponible</label>
                <input id="bientot" name="bientot" type="checkbox" value="on"<?php echo $checkedBientot ?>>
                <input id="bientotHidden" name='bientot' type='hidden' value='off'>
                &nbsp;
                <label for="rupture">En rupture de stock</label>
                <input id="rupture" name="rupture" type="checkbox" value="on"<?php echo $checkedRupture ?>>
                <input id="ruptureHidden" name='rupture' type='hidden' value='off'>
                &nbsp;
                <input type="submit" value="Rechercher">
            </form>
        </div>
    </div>
    <hr>
    <?php echo $tableGoodies ?>
</div><br>