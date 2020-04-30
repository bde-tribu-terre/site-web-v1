<script type="text/javascript">
    function surligne(element, erreur) {
        if (erreur) {
            element.classList.remove('input-valide');
            element.classList.add('input-invalide')
        } else {
            element.classList.remove('input-invalide');
            element.classList.add('input-valide')
        }
    }

    function verifForm(form) {
        let elements = form.elements
        for (let i = 0; i < elements.length; i++) {
            if (elements[i].type !== 'submit') {
                alert(elements[i].name + '\n' + elements[i].classList.contains('input-valide'));
            }
        }
        return false;
    }
</script>
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
                        <input class="form-control" id="formInscription_cleInscription" type="password" name="formInscription_cleInscription" placeholder="Saisir la clé d'inscription">
                        <small class="form-text text-muted">Demander cette clé au pôle informatique de l'association.</small>
                    </p>
                    <p> <!-- Prénom -->
                        <label for="formInscription_prenom">Prénom</label>
                        <input class="form-control" id="formInscription_prenom" type="text" name="formInscription_prenom" placeholder="Saisir votre prénom">
                        <small class="form-text text-muted">Première lettre en majuscule, le reste en minuscule (normal quoi...).</small>
                    </p>
                    <p> <!-- Nom -->
                        <label for="formInscription_nom">Nom</label>
                        <input class="form-control" id="formInscription_nom" type="text" name="formInscription_nom" placeholder="Saisir votre nom de famille">
                        <small class="form-text text-muted">Première lettre en majuscule, le reste en minuscule (pareil).</small>
                    </p>
                    <p> <!-- Login -->
                        <label for="formInscription_login">Login</label>
                        <input class="form-control" id="formInscription_login" type="text" name="formInscription_login" placeholder="Choisir le login">
                        <small class="form-text text-muted">Uniquement en minuscules.</small>

                    </p>
                    <p> <!-- Mot de passe -->
                        <label for="formInscription_mdp">Mot de passe</label>
                        <input class="form-control" id="formInscription_mdp" type="password" name="formInscription_mdp" placeholder="Choisir un mot de passe">
                        <small class="form-text text-muted">Peut contenir n'importe quel caractère (mais il faut bien s'en souvenir !!!).</small>
                    </p>
                    <p> <!-- Valider le mot de passe -->
                        <label for="formInscription_valierMdp">Recopier le mot de passe</label>
                        <input class="form-control" id="formInscription_valierMdp" type="password" name="formInscription_valierMdp" placeholder="Recopier le mot de passe">
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