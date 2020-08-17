<div class="container text-center">
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <h3>Ajouter une image à un goodie</h3>
                <hr>
                <form
                        id="formAjouterImageGoodie"
                        method="post"
                        enctype="multipart/form-data"
                        onsubmit="return verifForm(this);"
                >
                    <div class="form-group"> <!-- Goodie en question -->
                        <label for="formAjouterImageGoodie_id">
                            Goodie
                        </label>
                        <select
                                id="formAjouterImageGoodie_id"
                                name="formAjouterImageGoodie_id"
                                class="form-control"
                                onblur="verifNonVide(this);"
                        >
                            <option value="">--Choisir un goodie--</option>
                            <?php echo GOODIES ?>
                        </select>
                    </div>
                    <div class="div-group"> <!-- Image -->
                        <label for="formAjouterImageGoodie_image">
                            Sélectionner l'image
                        </label>
                        <input
                                id="formAjouterImageGoodie_image"
                                name="formAjouterImageGoodie_image"
                                type="file"
                                class="form-control"
                                accept="image/*"
                                onblur="verifNonVide(this);"
                        >
                        <small class="form-text text-muted">
                            ⚠️ Format : 4:3, pour éviter que ça nique la mise en page.<br>
                            🙏 Taille : 960px*720px.<br>
                            ⚠️ La miniature compte déjà comme une image. Attention aux doublons !
                        </small>
                    </div>
                    <hr>
                    <p> <!-- Ajouter l'image de goodie -->
                        <input
                                id="formAjouterImageGoodie_ajouter_submit"
                                name="formAjouterImageGoodie_ajouter_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Ajouter l'image"
                        >
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
                        <input
                                id="formRetourMenu_retourMenu_submit"
                                name="formRetourMenu_retourMenu_submit"
                                type="submit"
                                class="btn btn-var btn-block"
                                value="Retour au menu"
                        >
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>