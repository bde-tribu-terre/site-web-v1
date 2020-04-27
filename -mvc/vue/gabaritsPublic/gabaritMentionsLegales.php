<script type="text/javascript">
    function decoder(target, tel) {
        let elementTxtMail = document.getElementById(target + '_txt_mail');
        let strTxtMail = elementTxtMail.innerText;
        elementTxtMail.innerText = atob(strTxtMail);

        if (tel) {
            let elementTxtTel = document.getElementById(target + '_txt_tel');
            let strTxtTel = elementTxtTel.innerText;
            elementTxtTel.innerText = atob(strTxtTel);
        }

        let elementButton = document.getElementById(target + '_button');
        elementButton.setAttribute('disabled', '');
    }
</script>
<div class="container text-center">
    <h3>Mentions légales</h3>
    <hr>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div>
                <h3>Association Tribu-Terre</h3>
                <p>
                    <strong>Tribu-Terre</strong><br>
                    1A Rue de la Férollerie<br>
                    45071 Orléans Cedex 2, France
                <p>
                    Tél. : <span id="mailTT_txt_tel">MDEgMjMgNDUgNjcgODk=</span>
                </p>
                <p>
                    Courriel : <span id="mailTT_txt_mail">dHJpYnV0ZXJyZTBAZ21haWwuY29t</span>
                </p>
                <button id="mailTT_button" class="btn btn-danger text-center" onclick="decoder('mailTT', true);">Cliquer pour décrypter</button>
                <h3>Directeur/trice de publication</h3>
                <p>
                    <strong>NOM PRENOM</strong>
                </p>
                <p>
                    Courriel : <span id="mailDirPubli_txt_mail">RU1BSUw=</span>
                </p>
                <button id="mailDirPubli_button" class="btn btn-danger text-center" onclick="decoder('mailDirPubli');">Cliquer pour décrypter</button>
                <h3>Hébergeur</h3>
                <p>
                    <strong>Société OVH</strong><br>
                    2 rue Kellermann<br>
                    59100 Roubaix, France
                </p>
                <p>
                    Tél. : +33 (0)8 99 70 17 61
                </p>
                <p>
                    Site web : <a href="www.ovh.com">www.ovh.com</a>
                </p>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
</div><br>