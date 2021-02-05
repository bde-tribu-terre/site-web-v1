<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Signature</title>
</head>
<body>
<table
    style=
    "
                width: 512px;
                border-top: thin double black;
                border-bottom: thin double black;
                "
>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap');
    </style>
    <tbody>
    <tr>
        <td>
            <table style="font-size: medium;">
                <tbody>
                <tr>
                    <td>
                        <img
                            id="logo"
                            src="https://bde-tribu-terre.fr/mail/signatures/logos/tt.png"
                            alt="Tribu-Terre"
                            style="width: 110px"
                        >
                    </td>
                    <td>
                        <div style="width: 10px"></div>
                    </td>
                    <td style="text-align: left; width: 100%;">
                        <h1 style="margin: 5px 0 0 0; font-family: 'Roboto', sans-serif; font-weight: 500; letter-spacing: 2px; font-size: 24px;">
                            <?php echo isset($prenom) ? $prenom : 'Prénom' ?> <span style="font-variant: small-caps"><?php echo isset($nom) ? $nom : 'Nom' ?></span>
                        </h1>
                        <p style="margin: 0 0 5px 0; font-family: 'Roboto', sans-serif; font-weight: 300; letter-spacing: 2px; font-size: 14px;">
                            <?php echo isset($etudes) ? $etudes : 'Études' ?>
                        </p>
                        <div style="margin: 20px 0 20px 0; height: 4px; width: 75%; background: linear-gradient(to right, #d9534fFF, #d9534f00);"></div>
                        <p style="margin: 5px 0 5px 0; color: #d9534f; font-family: 'Roboto', sans-serif; font-weight: 300; letter-spacing: 2px; font-size: 14px;">
                            <?php echo isset($poste) ? $poste : 'Poste' ?>
                        </p>
                        <p style="display: none; margin: 5px 0 5px 0; font-family: 'Roboto', sans-serif; font-weight: 300; font-size: 14px;">
                            <a
                                href="mailto:<?php echo isset($mail) ? $mail : 'mail' ?>"
                            >
                                <?php echo isset($mail) ? $mail : 'mail' ?>
                            </a>
                        </p>
                    </td>
                    <td style="text-align: right;">
                        <table style="width: 22px;">
                            <tbody>
                            <tr>
                                <td style="height: 22px">
                                    <a
                                        href="https://bde-tribu-terre.fr/"
                                        target="_blank"
                                    ><img
                                            src="https://bde-tribu-terre.fr/mail/signatures/icons/website.png"
                                            alt="Facebook"
                                            width="20"
                                        ></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 22px">
                                    <a
                                        href="https://www.facebook.com/bdeTribuTerre/"
                                        target="_blank"
                                    ><img
                                            src="https://bde-tribu-terre.fr/mail/signatures/icons/facebook.png"
                                            alt="Facebook"
                                            width="20"
                                        ></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 22px">
                                    <a
                                        href="https://www.instagram.com/tribu.terre/"
                                        target="_blank"
                                    ><img
                                            src="https://bde-tribu-terre.fr/mail/signatures/icons/instagram.png"
                                            alt="Instagram"
                                            width="20"
                                        ></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="height: 22px">
                                    <a
                                        href="https://twitter.com/Tributerre45/"
                                        target="_blank"
                                    ><img
                                            src="https://bde-tribu-terre.fr/mail/signatures/icons/twitter.png"
                                            alt="Twitter"
                                            width="20"
                                        ></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
