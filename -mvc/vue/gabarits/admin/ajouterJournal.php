<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un journal</h3>
                <hr>
                <form id="formAjouterJournal" method="post" enctype="multipart/form-data" onsubmit="return verifForm(this);">
                    <div class="form-group"> <!-- Titre du journal -->
                        <label for="formAjouterJournal_titre">Titre du journal :</label>
                        <input onblur="verifNonVide(this);" oninput="garderMoins(this, 64);" class="form-control" id="formAjouterJournal_titre" type="text" placeholder="Titre" value="Omni-Sciences n°" name="formAjouterJournal_titre">
                    </div>
                    <div class="form-group"> <!-- Mois de sortie du journal -->
                        <label for="formAjouterJournal_mois">Mois de sortie du journal :</label>
                        <select onblur="verifNonVide(this);" class="form-control" id="formAjouterJournal_mois" name="formAjouterJournal_mois">
                            <option value="">--Choisir--</option>
                            <option value="01">Janvier</option>
                            <option value="02">Février</option>
                            <option value="03">Mars</option>
                            <option value="04">Avril</option>
                            <option value="05">Mai</option>
                            <option value="06">Juin</option>
                            <option value="07">Juillet</option>
                            <option value="08">Août</option>
                            <option value="09">Septembre</option>
                            <option value="10">Octobre</option>
                            <option value="11">Novembre</option>
                            <option value="12">Décembre</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Année de sortie du journal -->
                        <label for="formAjouterJournal_annee">Année de sortie du journal :</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formAjouterJournal_annee" type="number" value="2000" min="2000" max="2050" name="formAjouterJournal_annee" placeholder="Année">
                    </div>
                    <div class="form-group"> <!-- Fichier PDF -->
                        <label for="formAjouterJournal_fichierPDF">Sélectionner le journal</label>
                        <input onblur="verifNonVide(this);" class="form-control" type="file" id="formAjouterJournal_fichierPDF" name="formAjouterJournal_fichierPDF" accept="application/pdf">
                        <small class="form-text text-muted">Format PDF</small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter Journal -->
                        <input class="btn btn-danger btn-block" type="submit" value="Ajouter le journal" name="formAjouterJournal_ajouterJournal_submit">
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
                        <input class="btn btn-danger btn-block" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu_submit">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>