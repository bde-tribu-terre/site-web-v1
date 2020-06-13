<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Connexion</h3>
                <hr>
                <form id="formConnexion" method="post" onsubmit="return verifForm(this);">
                    <p> <!-- Identifiant -->
                        <label for="formConnexion_login">Identifiant</label>
                        <input onblur="verifNonVide(this);" oninput="garderMinuscules(this);" class="form-control" id="formConnexion_login" type="text" name="formConnexion_login" placeholder="Saisir votre identifiant">
                    </p>
                    <p> <!-- Mot de passe -->
                        <label for="formConnexion_mdp">Mot de passe</label>
                        <input onblur="verifNonVide(this);" class="form-control" id="formConnexion_mdp" type="password" name="formConnexion_mdp" placeholder="Saisir votre mot de passe">
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