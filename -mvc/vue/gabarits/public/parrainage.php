<div class="container text-center">
    <h3>Parrainage</h3>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <form id="formRechercherMail" method="post" onsubmit="return verifForm(this);">
                <div class="form-group"> <!-- Email recherché -->
                    <label for="formRechercherMail_mail">
                        Saisissez l'adresse e-mail avec laquelle vous vous êtes inscrit(e) au parrainage Tribu-Terre.
                    </label>
                    <input
                            id="formRechercherMail_mail"
                            name="formRechercherMail_mail"
                            type="text"
                            class="form-control"
                            placeholder="E-mail"
                            onblur="verifNonVide(this);"
                            oninput="garderMoins(this, 128);"
                    >
                </div>
                <hr>
                <div class="form-group"> <!-- Rechercher -->
                    <input
                            id="formRechercherMail_rechercher_submit"
                            name="formRechercherMail_rechercher_submit"
                            type="submit"
                            class="btn btn-var btn-block"
                            value="Rechercher"
                    >
                </div>
            </form>
        </div>
    </div>
</div>
