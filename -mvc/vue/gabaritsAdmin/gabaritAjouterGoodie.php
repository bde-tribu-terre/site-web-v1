<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <h3>Menu principal</h3>
            <hr>
            <?php
            if (!empty($messageRetour)) {
                echo
                    '<div class="well">' .
                    '<h3>Message : </h3>' .
                    '<p><strong>' . $messageRetour . '</strong></p>' .
                    '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter un goodie</h3>
                <hr>
                <form id="formAjouterGoodie" method="post" enctype="multipart/form-data">
                    <div class="form-group"> <!-- Titre du goodie -->
                        <label for="formAjouterGoodie_titreGoodie">Titre du goodie</label>
                        <input class="form-control" id="formAjouterGoodie_titreGoodie" type="text" name="formAjouterGoodie_titreGoodie" placeholder="Titre">
                    </div>
                    <div class="form-group"> <!-- Catégorie -->
                        <label for="formAjouterGoodie_categorie">Catégorie</label>
                        <select class="form-control" id="formAjouterGoodie_categorie" name="formAjouterGoodie_categorie">
                            <option value="-1">--Choisir--</option>
                            <option value="0">Caché</option>
                            <option value="1">Disponible</option>
                            <option value="2">Bientôt disponible</option>
                            <option value="3">En rupture de stock</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Prix adhérent -->
                        <label for="formAjouterGoodie_prixAdhérentEuro">Prix adhérent</label>
                        <input class="form-control" id="formAjouterGoodie_prixAdhérentEuro" type="number" min="0" name="formAjouterGoodie_prixAdhérentEuro" placeholder="Euros">
                        <small class="form-text text-muted">Euros</small>
                        <input class="form-control" id="formAjouterGoodie_prixAdhérentCentimes" type="number" min="0" max="99" name="formAjouterGoodie_prixAdhérentCentimes" placeholder="Centimes">
                        <small class="form-text text-muted">Centimes</small>
                    </div>
                    <div class="form-group"> <!-- Prix non-adhérent -->
                        <label for="formAjouterGoodie_prixNonAdhérentEuro">Prix non-adhérent</label>
                        <input class="form-control" id="formAjouterGoodie_prixNonAdhérentEuro" type="number" min="0" name="formAjouterGoodie_prixNonAdhérentEuro" placeholder="Euros">
                        <small class="form-text text-muted">Euros</small>
                        <input class="form-control" id="formAjouterGoodie_prixNonAdhérentCentimes" type="number" min="0" max="99" name="formAjouterGoodie_prixNonAdhérentCentimes" placeholder="Centimes">
                        <small class="form-text text-muted">Centimes</small>
                    </div>
                    <div class="form-group"> <!-- Description du goodie -->
                        <label for="formAjouterGoodie_descGoodie">Description du goodie</label>
                        <textarea class="form-control" id="formAjouterGoodie_descGoodie" placeholder="Description du goodie" name="formAjouterGoodie_descGoodie"></textarea>
                        <small class="form-text text-muted">Sur PC, vous pouvez augmenter la taille de la zone de saisie en bas à droite.</small>
                    </div>
                    <div class="form-group"> <!-- Miniature -->
                        <label for="formAjouterGoodie_miniature">Sélectionner la miniature</label>
                        <input class="form-control" type="file" name="formAjouterGoodie_miniature" accept="image/*">
                        <small class="form-text text-muted">⚠️ Format : 4:3, pour éviter que ça nique la mise en page.<br>🙏 Taille : 960px*720px.</small>
                    </div>
                    <small  class="form-text text-muted">Pour ajouter les images qui seront affichées sur la page du goodie, il faut ajouter le goodie, puis retourner sur le menu admin, et aller dans "ajouter une image à un goodie".</small>
                    <hr>
                    <div class="form-group"> <!-- Ajouter Goodie -->
                        <input class="btn btn-primary" type="submit" value="Ajouter le goodie" name="formAjouterGoodie_ajouterGoodie">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Retour au menu</h3>
                <hr>
                <form id="formRetourMenu" method="post">
                    <p> <!-- Retour au menu -->
                        <input class="btn btn-primary" type="submit" value="Retour au menu" name="formRetourMenu_retourMenu">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>