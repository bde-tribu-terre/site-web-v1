<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Connexion</h3>
                <hr>
                <form id="formConnexion" method="post" onsubmit="return verifForm(this);">
                    <p> <!-- Identifiant -->
                        <label for="formConnexion_login">
                            Identifiant
                        </label>
                        <input
                                id="formConnexion_login"
                                name="formConnexion_login"
                                type="text"
                                class="form-control"
                                placeholder="Saisir votre identifiant"
                                onblur="verifNonVide(this);"
                                oninput="garderMinuscules(this);"
                        >
                    </p>
                    <p> <!-- Mot de passe -->
                        <label for="formConnexion_mdp">
                            Mot de passe
                        </label>
                        <input
                                id="formConnexion_mdp"
                                name="formConnexion_mdp"
                                type="password"
                                class="form-control"
                                placeholder="Saisir votre mot de passe"
                                onblur="verifNonVide(this);"
                        >
                    </p>
                    <hr>
                    <p> <!-- Se connecter -->
                        <input
                                id="formConnexion_seConnecter_submit"
                                name="formConnexion_seConnecter_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Se connecter"
                        >
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
