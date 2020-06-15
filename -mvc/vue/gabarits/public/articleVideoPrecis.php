<div class="container text-center">
    <h4 class="pc"><?php echo CATEGORIE ?></h4>
    <h3><?php echo TITRE ?></h3>
    <h5>📅 <?php echo DATE_CREATION ?> | ✏️ <?php echo AUTEUR ?></h5>
    <hr>
    <?php echo INTEGRATION_VIDEO ?>
    <div class="row text-left retrait">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <?php echo TEXTE ?>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <!-- Twitter -->
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
               class="twitter-share-button"
               data-size="large"
               data-text="Cet article de Tribu-Terre est très intéressant : <?php echo TITRE ?> !"
               data-via="Tributerre45"
               data-show-count="false">
                Tweet
            </a>
            <script async
                    src="https://platform.twitter.com/widgets.js"
                    charset="utf-8">
            </script>
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
            <div class="fb-share-button"
                 data-href="http://barodine.fr/tribu-terre/articles?id=V<?php echo ID ?>"
                 data-layout="button"
                 data-size="large">
                <a target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                   class="fb-xfbml-parse-ignore">Partager</a>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div><br>
</div>