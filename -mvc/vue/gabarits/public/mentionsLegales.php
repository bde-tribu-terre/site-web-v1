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
                </p>
                <p id="telAnael_div">
                    <!-- Tel de Anaël BARODINE, président. -->
                    Tél. :
                    <span id="telAnael_base64">
                        <?php echo base64_encode('07 83 45 58 00') ?>
                    </span>
                </p>
                <button
                        id="telAnael_button"
                        class="btn btn-var"
                        onclick="decoder('telAnael', 'span');"
                >
                    Cliquer pour décrypter
                </button>
                <p id="mailTT_div">
                    Courriel :
                    <span id="mailTT_base64">
                        <?php echo base64_encode('contact@bde-tribu-terre.fr') ?>
                    </span>
                </p>
                <button
                        id="mailTT_button"
                        class="btn btn-var"
                        onclick="decoder('mailTT', 'span');"
                >
                    Cliquer pour décrypter
                </button>
                <h3>
                    Directeur de publication
                </h3>
                <p>
                    <strong>Anaël <span class="pc">Barodine</span></strong>
                </p>
                <p id="mailDirPubli_div">
                    Courriel :
                    <span id="mailDirPubli_base64">
                        <?php echo base64_encode('informatique@bde-tribu-terre.fr') ?>
                    </span>
                </p>
                <button
                        id="mailDirPubli_button"
                        class="btn btn-var"
                        onclick="decoder('mailDirPubli', 'span');"
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
</div>
