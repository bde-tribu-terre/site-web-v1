<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Inscription</h3>
                <hr>
                <form id="formConnexion" method="post" onsubmit="return verifForm(this);">
                    <p> <!-- Clé d'inscription -->
                        <label for="formInscription_cleInscription">
                            Clé d'inscription
                        </label>
                        <input
                                id="formInscription_cleInscription"
                                name="formInscription_cleInscription"
                                type="password"
                                class="form-control"
                                placeholder="Saisir la clé d'inscription"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Demander cette clé au pôle informatique de l'association.
                        </small>
                    </p>
                    <p> <!-- Prénom -->
                        <label for="formInscription_prenom">
                            Prénom
                        </label>
                        <input
                                id="formInscription_prenom"
                                name="formInscription_prenom"
                                type="text"
                                class="form-control"
                                placeholder="Saisir votre prénom"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 64);"
                        >
                        <small class="form-text text-muted">
                            Première lettre en majuscule, le reste en minuscule (normal quoi...).
                        </small>
                    </p>
                    <p> <!-- Nom -->
                        <label for="formInscription_nom">
                            Nom
                        </label>
                        <input
                                id="formInscription_nom"
                                name="formInscription_nom"
                                type="text"
                                class="form-control"
                                placeholder="Saisir votre nom de famille"
                                onblur="verifNonVide(this);"
                                oninput="garderMoins(this, 64);"
                        >
                        <small class="form-text text-muted">
                            Première lettre en majuscule, le reste en minuscule (pareil).
                        </small>
                    </p>
                    <p> <!-- Login -->
                        <label for="formInscription_login">
                            Login
                        </label>
                        <input
                                id="formInscription_login"
                                name="formInscription_login"
                                type="text"
                                class="form-control"
                                placeholder="Choisir le login"
                                onblur="verifNonVide(this);"
                                oninput="garderMinuscules(this); garderMoins(this, 64);"
                        >
                        <small class="form-text text-muted">
                            Uniquement en minuscules.
                        </small>
                    </p>
                    <p> <!-- Mot de passe -->
                        <label for="formInscription_mdp">
                            Mot de passe
                        </label>
                        <input
                                id="formInscription_mdp"
                                name="formInscription_mdp"
                                type="password"
                                class="form-control"
                                placeholder="Choisir un mot de passe"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            Peut contenir n'importe quel caractère (mais il faut bien s'en souvenir !!!).
                        </small>
                    </p>
                    <p> <!-- Valider le mot de passe -->
                        <label for="formInscription_mdp_verif">
                            Recopier le mot de passe
                        </label>
                        <input
                                id="formInscription_mdp_verif"
                                name="formInscription_mdp_verif"
                                type="password"
                                class="form-control"
                                placeholder="Recopier le mot de passe"
                                onblur="verifMdpIdentique(this);"
                        >
                        <small class="form-text text-muted">
                            Les mots de passe sont encryptés avant d'être enregistrés dans la base de données. Le pôle
                            informatique de l'association vous assure qu'ils sont illisibles et indécryptables même pour
                            des membres du bureau.
                        </small>
                    </p>
                    <hr>
                    <p> <!-- S'inscrire -->
                        <input
                                id="formInscription_inscription_submit"
                                name="formInscription_inscription_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="S'inscrire"
                        >
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
