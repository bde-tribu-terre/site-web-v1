<link rel="stylesheet" type="text/css" href="<?php echo RACINE . '-mvc/vue/universite.css' ?>">
<div class="container text-center">
    <h3>Université d'Orléans</h3>
    <hr>
    <div class="row">
        <!-- Auteur : Anaël BARODINE. -->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <p class="text-justify retrait">
                Le campus de l'Université d'Orléans, dans le quartier Orléanais de La Source, est le lieu dans lequel se
                situent la plus grande partie des enseignements proposés par l'Université. Il comporte des bâtiments de
                cours, aussi bien théoriques que pratiques, de nombreuses résidences étudiantes, des restaurants
                universitaires, des bibliothèques universitaires et des lieux de vie et de divertissement pour les
                étudiants. Il comporte également
                <a href="https://www.univ-orleans.fr/fr/univ/recherche/laboratoires-et-structures" target="_blank">
                de nombreux laboratoires scientifiques</a>, ce qui permet une accessibilité au domaine de la recherche
                pour les étudiants de la majeure partie des disciplines enseignées.
            </p>
            <p class="text-justify retrait">
                Ci-dessous une carte interactive du campus. Survolez avec la souris (touchez sur appareil mobile) une
                zone de couleur pour obtenir des informations sur le bâtiment en question.
            </p>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="img-arrondi ombre text-center" style="height: 80vh">
                <iframe
                        style="border:none;overflow:hidden"
                        width="100%"
                        height="100%"
                        scrolling="no"
                        frameborder="0"
                        title="Plan Interactif du Campus"
                        src="<?php echo RACINE . 'api/plan-universite/' ?>"
                ></iframe>
            </div>
        </div>
    </div>
</div>
