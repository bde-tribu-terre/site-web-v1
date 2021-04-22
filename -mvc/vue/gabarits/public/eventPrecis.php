<div class="container text-center">
    <h3><?php echo TITRE ?></h3>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <div class="well">
                <h3>Date 📅</h3>
                <h2><?php echo DATE ?></h2>
                <h3><?php echo NB_JOURS ?></h3>
                <hr>
                <h3>Heure ⌚</h3>
                <h2><?php echo HEURE ?></h2>
                <hr>
                <h3>Lieu 📍</h3>
                <h2><?php echo LIEU ?></h2>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="well">
                <h3>Informations</h3>
                <hr>
                <p>
                    <?php echo DESC ?>
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <!-- Twitter -->
            <a
                    href="https://twitter.com/share?ref_src=twsrc%5Etfw"
                    class="twitter-share-button"
                    data-size="large"
                    data-text="Cet événement organisé par Tribu-Terre va être cool : <?php echo TITRE ?> !"
                    data-via="Tributerre45"
                    data-show-count="false"
            >
                Tweet
            </a>
            <script
                    async
                    src="https://platform.twitter.com/widgets.js"
                    charset="utf-8"
            ></script>
            <!-- Facebook -->
            <div id="fb-root"></div>
            <script>
                (
                    function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk')
                );
            </script>
            <div
                    class="fb-share-button"
                    data-href="https://<?php echo $_SERVER["HTTP_HOST"] ?>/events?id=<?php echo ID ?>"
                    data-layout="button"
                    data-size="large"
            >
                <a
                        target="_blank"
                        href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                        class="fb-xfbml-parse-ignore"
                >
                    Partager
                </a>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>
