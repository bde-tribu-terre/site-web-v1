<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
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
        <div class="col-sm-12">
            <div class="well">
                <h3>Connexion</h3>
                <hr>
                <form id="formConnexion" method="post">
                    <p> <!-- Identifiant -->
                        <label for="formConnexion_login">Identifiant</label>
                        <input class="form-control" id="formConnexion_login" type="text" name="formConnexion_login" placeholder="Saisir votre identifiant">
                    </p>
                    <p> <!-- Mot de passe -->
                        <label for="formConnexion_mdp">Mot de passe</label>
                        <input class="form-control" id="formConnexion_mdp" type="password" name="formConnexion_mdp" placeholder="Saisir votre mot de passe">
                    </p>
                    <hr>
                    <p> <!-- Se connecter -->
                        <input class="btn btn-danger btn-block" type="submit" value="Se connecter" name="formConnexion_seConnecter">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div><br>