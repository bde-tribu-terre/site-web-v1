# Arborescence
Il y a, à l'heure actuelle, 2 MVC :
- MVC "public", dans le répertoire racine
- MVC "admin", dans le répertoire ./admin

On pourra fusionner, ou pas, les deux MVC :
Cela rendrait la compréhension, et donc la continuation
compliquée.  
De plus, ce sont deux parties du site qui sont totalement
indépendantes l'une de l'autre.

- Racine <- MVC public
  - /mvcpublic
    - /controleur
      - controleur.php
    - /modele
      - modele.php
    - /vue
      - /gabarits
        - {Tous les gabarits du MVC public}
      - cadre.php
      - vue.php
  - /global
    - /images
      - {Toutes les images du site}
    - connect.php
    - header.php
    - footer.php
    - global.css <-(version ordinateur)
  - /ressources
    - /journaux
      - {Tous les journaux en format PDF}
    - /statuts
      - {Les statuts en format PDF, possibilité de mettre
      les anciens ou pas}
    - /articles
      - A voir encore comment on stocke les articles.
    - /events
      - Pareil, à voir comment stocker les events.
  - /admin <- MVC admin
    - ...MVC classique...