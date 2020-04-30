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
                <form id="formConnexion" method="post" onsubmit="return verifForm(this);">
                    <p> <!-- Clé d'inscription -->
                        <label for="formInscription_cleInscription">Clé d'inscription</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formInscription_cleInscription" type="password" name="formInscription_cleInscription" placeholder="Saisir la clé d'inscription">
                        <small class="form-text text-muted">Demander cette clé au pôle informatique de l'association.</small>
                    </p>
                    <p> <!-- Prénom -->
                        <label for="formInscription_prenom">Prénom</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formInscription_prenom" type="text" name="formInscription_prenom" placeholder="Saisir votre prénom">
                        <small class="form-text text-muted">Première lettre en majuscule, le reste en minuscule (normal quoi...).</small>
                    </p>
                    <p> <!-- Nom -->
                        <label for="formInscription_nom">Nom</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formInscription_nom" type="text" name="formInscription_nom" placeholder="Saisir votre nom de famille">
                        <small class="form-text text-muted">Première lettre en majuscule, le reste en minuscule (pareil).</small>
                    </p>
                    <p> <!-- Login -->
                        <label for="formInscription_login">Login</label>
                        <input onblur="verifNonVide(this);" onchange="this.value.toLowerCase();" class="form-control" id="formInscription_login" type="text" name="formInscription_login" placeholder="Choisir le login">
                        <small class="form-text text-muted">Uniquement en minuscules.</small>
                    </p>
                    <p> <!-- Mot de passe -->
                        <label for="formInscription_mdp">Mot de passe</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formInscription_mdp" type="password" name="formInscription_mdp" placeholder="Choisir un mot de passe">
                        <small class="form-text text-muted">Peut contenir n'importe quel caractère (mais il faut bien s'en souvenir !!!).</small>
                    </p>
                    <p> <!-- Valider le mot de passe -->
                        <label for="formInscription_mdp_verif">Recopier le mot de passe</label>
                        <input onblur="verifMdpIdentique(this);" class="form-control" id="formInscription_mdp_verif" type="password" name="formInscription_mdp_verif" placeholder="Recopier le mot de passe">
                        <small class="form-text text-muted">
                            Les mots de passe sont encryptés avant d'être enregistrés dans la base de données. Le pôle
                            informatique de l'association vous assure qu'ils sont illisibles et indécryptables même pour
                            des membres du bureau.
                        </small>
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