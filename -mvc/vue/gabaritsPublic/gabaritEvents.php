<div class="container text-center">
    <h3>Évents</h3>
    <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#recherche" aria-expanded="<?php echo $rechercheEnCoursStr ?>">
        Options de recherche...
    </button>
    <div class="collapse<?php if ($rechercheEnCours) { echo ' in'; } ?>" id="recherche" aria-expanded="<?php echo $rechercheEnCoursStr ?>">
        <div class="card card-body">
            <form method="get" onsubmit="check()">
                <script>
                    function check() {
                        if(document.getElementById("aVenir").checked) {
                            document.getElementById('aVenirHidden').disabled = true;
                        }
                        if(document.getElementById("passes").checked) {
                            document.getElementById('passesHidden').disabled = true;
                        }
                    }
                </script>
                <label for="tri">Trier par :</label>
                <select id="tri" name="tri">
                    <option value="FP"<?php if ($rechercheEnCours && $tri == 'FP') { echo ' selected'; } ?>>Futur vers passé</option>
                    <option value="PF"<?php if ($rechercheEnCours && $tri == 'PF') { echo ' selected'; } ?>>Passé vers futur</option>
                </select>
                &nbsp;
                <label for="aVenir">A venir</label>
                <input id="aVenir" name="aVenir" type="checkbox" value="on"<?php echo $checkedAVenir ?>>
                <input id="aVenirHidden" name='aVenir' type='hidden' value='off'>
                &nbsp;
                <label for="passes">Passés</label>
                <input id="passes" name="passes" type="checkbox" value="on"<?php echo $checkedPasses ?>>
                <input id="passesHidden" name='passes' type='hidden' value='off'>
                &nbsp;
                <input type="submit" value="Rechercher">
            </form>
        </div>
    </div>
    <hr>
    <?php echo $tableEvents ?>
</div><br>