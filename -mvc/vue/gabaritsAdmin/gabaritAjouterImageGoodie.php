<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
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
                <h3>Ajouter une image à un goodie</h3>
                <hr>
                <form id="formAjouterImageGoodie" method="post" enctype="multipart/form-data">
                    <div class="form-group"> <!-- Goodie en question -->
                        <label for="formAjouterImageGoodie_idGoodie">Goodie</label>
                        <select class="form-control" id="formAjouterImageGoodie_idGoodie" name="formAjouterImageGoodie_idGoodie">
                            <option value="">--Choisir un goodie--</option>
                            <?php echo $goodies ?>
                        </select>
                    </div>
                    <div class="div-group"> <!-- Image -->
                        <label for="formAjouterImageGoodie_image">Sélectionner l'image</label>
                        <input class="form-control" type="file" name="formAjouterImageGoodie_image" accept="image/*">
                        <small class="form-text text-muted">⚠️ Format : 4:3, pour éviter que ça nique la mise en page.<br>🙏 Taille : 960px*720px.<br>⚠️ La miniature compte déjà comme une image. Attention aux doublons !</small>
                    </div>
                    <hr>
                    <p> <!-- Ajouter Goodie -->
                        <input class="btn btn-primary" type="submit" value="Ajouter l'image" name="formAjouterImageGoodie_ajouter">
                    </p>
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