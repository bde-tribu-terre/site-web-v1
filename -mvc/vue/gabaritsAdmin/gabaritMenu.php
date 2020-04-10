<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <h3>Menu principal</h3>
            <hr>
            <?php
            if (!empty($messageRetour)) {
                echo
                    '<div class="well">' .
                        '<h3>Message : </h3>' .
                        '<p><strong>' . $messageRetour . '</strong></p>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <h3>Events</h3>
                <hr>
                <form id="formEvents" method="post">
                    <p> <!-- Créer un évent -->
                        <input class="btn btn-primary" type="submit" value="Créer un évent" name="formEvents_creerEventMenu">
                    </p>
                    <p> <!-- Modifier un évent -->
                        <input class="btn btn-primary" type="submit" value="Modifier un évent" name="formEvents_modifierEventMenu">
                    </p>
                    <p> <!-- Supprimer un évent -->
                        <input class="btn btn-primary" type="submit" value="Supprimer un évent" name="formEvents_supprimerEventMenu">
                    </p>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <h3>Goodies</h3>
                <hr>
                <form id="formGoodies" method="post">
                    <p> <!-- Ajouter un goodie -->
                        <input class="btn btn-primary" type="submit" value="Ajouter un goodie" name="formGoodies_ajouterGoodieMenu">
                    </p>
                    <p> <!-- Ajouter une image à un goodie -->
                        <input class="btn btn-primary" type="submit" value="Ajouter une image à un goodie" name="formGoodies_ajouterImageGoodieMenu">
                    </p>
                    <p> <!-- Modifier un goodie -->
                        <input class="btn btn-primary" type="submit" value="Modifier un goodie" name="formGoodies_ModifierGoodieMenu">
                    </p>
                    <p> <!-- Supprimer un goodie -->
                        <input class="btn btn-primary" type="submit" value="Supprimer un goodie" name="formGoodies_SupprimerGoodieMenu">
                    </p>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <h3>Journal</h3>
                <hr>
                <form id="formJournal" method="post">
                    <p> <!-- Ajouter un journal -->
                        <input class="btn btn-primary" type="submit" value="Ajouter un journal" name="formJournal_ajouterJournalMenu">
                    </p>
                    <p> <!-- Supprimer un journal -->
                        <input class="btn btn-primary" type="submit" value="Supprimer un journal" name="formJournal_supprimerJournalMenu">
                    </p>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <h3>Journal</h3>
                <hr>
                <form id="formLog" method="post">
                    <p> <!-- Voir le log -->
                        <input class="btn btn-primary" type="submit" value="Voir le log" name="formLog_afficherLog">
                    </p>
                </form>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <h3>Se déconnecter</h3>
                <hr>
                <form id="formDeconnexion" method="post">
                    <p> <!-- Se déconnecter -->
                        <input class="btn btn-primary" type="submit" value="Se déconnecter" name="formDeconnexion_deconnexion">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div><br>