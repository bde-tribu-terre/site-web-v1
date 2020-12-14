<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un journal</h3>
                <hr>
                <form
                        id="formAjouterJournal"
                        method="post"
                        enctype="multipart/form-data"
                        onsubmit="return verifForm(this);"
                >
                    <div class="form-group"> <!-- Titre du journal -->
                        <label for="formAjouterJournal_titre">
                            Titre du journal
                        </label>
                        <input
                                id="formAjouterJournal_titre"
                                name="formAjouterJournal_titre"
                                type="text"
                                class="form-control"
                                placeholder="Titre"
                                value="Omni-Sciences n°"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 64);"
                        >
                    </div>
                    <div class="form-group"> <!-- Mois de sortie du journal -->
                        <label for="formAjouterJournal_mois">
                            Mois de sortie du journal
                        </label>
                        <select
                                id="formAjouterJournal_mois"
                                name="formAjouterJournal_mois"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
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
                        <label for="formAjouterJournal_annee">
                            Année de sortie du journal
                        </label>
                        <input
                                id="formAjouterJournal_annee"
                                name="formAjouterJournal_annee"
                                type="number"
                                class="form-control"
                                min="2000"
                                max="2050"
                                placeholder="Année"
                                value="2000"
                                onblur="verifNonVide(this);"
                        >
                    </div>
                    <div class="form-group"> <!-- Fichier PDF -->
                        <label for="formAjouterJournal_fichierPDF">
                            Sélectionner le journal
                        </label>
                        <input
                                id="formAjouterJournal_fichierPDF"
                                name="formAjouterJournal_fichierPDF"
                                type="file"
                                class="form-control"
                                accept="application/pdf"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Format PDF
                        </small>
                    </div>
                    <hr>
                    <div class="form-group"> <!-- Ajouter Journal -->
                        <input
                                id="formAjouterJournal_ajouterJournal_submit"
                                name="formAjouterJournal_ajouterJournal_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Ajouter le journal"
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
