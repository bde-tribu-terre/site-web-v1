<script type="text/javascript">
    function decoder(target) {
        let elementBase64 = document.getElementById(target + '_base64');
        let strBase64 = elementBase64.innerText;
        let strMail = atob(strBase64);
        let elementDiv = document.getElementById(target + '_div');
        elementDiv.removeChild(elementBase64);

        let elementMail = document.createElement('h4');
        elementMail.setAttribute('id', target + '_mail');
        elementMail.innerText = strMail;
        elementDiv.appendChild(elementMail);

        let elementButton = document.getElementById(target + '_button');
        elementButton.setAttribute('disabled', '')
    }
</script>
<div class="container text-center">
    <h3>Contact</h3>
    <hr>
    <div class="row">
        <!-- Auteur : Jade BEAUMONT. -->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <p class="text-justify retrait">
                Vous découvrez Tribu-Terre et voulez en savoir plus ? Vous avez simplement une question pour votre
                bureau ? Vous pouvez contacter chacun de nos pôles sur leurs adresses mails respectives mais aussi notre
                adresse mail générale.
            </p>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="well">
                <h3>Adresse générale</h3>
                <hr>
                <div id="generale_div" style="height: 50px; word-wrap: break-word;">
                    <p id="generale_base64"><strong>dHJpYnV0ZXJyZTBAZ21haWwuY29t</strong></p>
                </div>
                <button id="generale_button" class="btn btn-danger" onclick="decoder('generale');">Cliquer pour décrypter</button>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <h3>Pôle Communication</h3>
                <hr>
                <div id="communication_div" style="height: 50px; word-wrap: break-word;">
                    <p id="communication_base64"><strong>dHJpYnV0ZXJyZS5jb21tdW5pY2F0aW9uQGdtYWlsLmNvbQ==</strong></p>
                </div>
                <button id="communication_button" class="btn btn-danger" onclick="decoder('communication');">Cliquer pour décrypter</button>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <h3>Pôle Journal</h3>
                <hr>
                <div id="journal_div" style="height: 50px; word-wrap: break-word;">
                    <p id="journal_base64"><strong>dHJpYnV0ZXJyZS5qb3VybmFsQGdtYWlsLmNvbQ==</strong></p>
                </div>
                <button id="journal_button" class="btn btn-danger" onclick="decoder('journal');">Cliquer pour décrypter</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <h3>Pôle Culture</h3>
                <hr>
                <div id="culture_div" style="height: 50px; word-wrap: break-word;">
                    <p id="culture_base64"><strong>dHJpYnV0ZXJyZS5jdWx0dXJlQGdtYWlsLmNvbQ==</strong></p>
                </div>
                <button id="culture_button" class="btn btn-danger" onclick="decoder('culture');">Cliquer pour décrypter</button>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <h3>Pôle Partenariat</h3>
                <hr>
                <div id="partenariat_div" style="height: 50px; word-wrap: break-word;">
                    <p id="partenariat_base64"><strong>dHJpYnV0ZXJyZS5wYXJ0ZW5hcmlhdEBnbWFpbC5jb20=</strong></p>
                </div>
                <button id="partenariat_button" class="btn btn-danger" onclick="decoder('partenariat');">Cliquer pour décrypter</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="well">
                <h3>Pôle Informatique</h3>
                <hr>
                <div id="informatique_div" style="height: 50px; word-wrap: break-word;">
                    <p id="informatique_base64"><strong>dHJpYnV0ZXJyZS5pbmZvcm1hdGlxdWVAZ21haWwuY29t</strong></p>
                </div>
                <button id="informatique_button" class="btn btn-danger" onclick="decoder('informatique');">Cliquer pour décrypter</button>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div><br>