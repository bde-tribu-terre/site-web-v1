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
                <h3>
                    Association Tribu-Terre
                </h3>
                <p>
                    <strong>Tribu-Terre</strong><br>
                    1A Rue de la Férollerie<br>
                    45071 Orléans Cedex 2, France
                <p>
                    <!-- Tel de Simon MEDELLI, président. -->
                    Tél. : <span id="mailTT_txt_tel">MDYgNTIgNDkgMzggMzg=</span>
                </p>
                <p>
                    Courriel : <span id="mailTT_txt_mail">dHJpYnV0ZXJyZTBAZ21haWwuY29t</span>
                </p>
                <button
                        id="mailTT_button"
                        class="btn btn-var text-center"
                        onclick="decoder('mailTT', true);"
                >
                    Cliquer pour décrypter
                </button>
                <h3>
                    Directeur de publication
                </h3>
                <p>
                    <strong>Simon <span class="pc">Medelli</span></strong>
                </p>
                <p>
                    Courriel : <span id="mailDirPubli_txt_mail">c2ltb25tZWRlbGxpMkBnbWFpbC5jb20=</span>
                </p>
                <button
                        id="mailDirPubli_button"
                        class="btn btn-var text-center"
                        onclick="decoder('mailDirPubli');"
                >
                    Cliquer pour décrypter
                </button>
                <h3>
                    Hébergement Web
                </h3>
                <p>
                    <strong>NUXIT - GROUPE MAGIC ONLINE</strong><br>
                    RCS 451 146 757 BOBIGNY<br>
                    Code APE 6311Z<br>
                    132-134 Avenue du Président Wilson<br>
                    93512 Montreuil sous Bois Cedex, France<br>
                </p>
                <p>
                    Tél. : +33 (0)1 41 58 22 50
                </p>
                <p>
                    Site web : <a href="https://www.nuxit.com">nuxit.com</a>
                </p>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
</div><br>