<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <?php
            if (!empty(MESSAGE_RETOUR)) {
                echo
                    '<div class="well">' .
                    '<h3>Message : </h3>' .
                    '<p><strong>' . MESSAGE_RETOUR . '</strong></p>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Inscription</h3>
                <hr>
                <form id="formConnexion" method="post">
                    <p> <!-- Clé d'inscription -->
                        <label for="formInscription_cleInscription">Clé d'inscription</label>
                        <input class="form-control" id="formInscription_cleInscription" type="password" name="formInscription_cleInscription" placeholder="Saisir la clé d'inscription">
                    </p>
                    <p> <!-- Prénom -->
                        <label for="formInscription_prenom">Prénom</label>
                        <input class="form-control" id="formInscription_prenom" type="text" name="formInscription_prenom" placeholder="Saisir votre prénom">
                    </p>
                    <p> <!-- Nom -->
                        <label for="formInscription_nom">Nom</label>
                        <input class="form-control" id="formInscription_nom" type="text" name="formInscription_nom" placeholder="Saisir votre nom de famille">
                    </p>
                    <p> <!-- Login -->
                        <label for="formInscription_login">Login</label>
                        <input class="form-control" id="formInscription_login" type="text" name="formInscription_login" placeholder="Choisir le login">
                    </p>
                    <p> <!-- Mot de passe -->
                        <label for="formInscription_mdp">Mot de passe</label>
                        <input class="form-control" id="formInscription_mdp" type="password" name="formInscription_mdp" placeholder="Choisir un mot de passe">
                    </p>
                    <p> <!-- Valider le mot de passe -->
                        <label for="formInscription_valierMdp">Recopier le mot de passe</label>
                        <input class="form-control" id="formInscription_valierMdp" type="password" name="formInscription_valierMdp" placeholder="Recopier le mot de passe">
                    </p>
                    <hr>
                    <p> <!-- S'inscrire -->
                        <input class="btn btn-danger btn-block" type="submit" value="S'inscrire" name="formInscription_inscription">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div><br>