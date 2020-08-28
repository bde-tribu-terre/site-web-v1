USE TRIBUTERRE;
# -----------------------------------------------------------------------------
#       TABLE : Journaux
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Journaux
 (
   idJournaux INTEGER NOT NULL AUTO_INCREMENT ,
   titreJournaux VARCHAR(64) NOT NULL  ,
   dateJournaux date NOT NULL  ,
   pdfJournaux VARCHAR(128) NOT NULL  
   , PRIMARY KEY (idJournaux) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ClesInscriptions
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ClesInscriptions
 (
   idClesInscriptions INTEGER NOT NULL AUTO_INCREMENT  ,
   strClesInscriptions VARCHAR(128) NOT NULL  
   , PRIMARY KEY (idClesInscriptions) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : Membres
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Membres
 (
   idMembres INTEGER NOT NULL AUTO_INCREMENT ,
   loginMembres VARCHAR(64) NOT NULL  ,
   mdpHashMembres VARCHAR(128) NOT NULL  ,
   mdpSaltMembres VARCHAR(32) NOT NULL  ,
   prenomMembres VARCHAR(64) NOT NULL  ,
   nomMembres VARCHAR(64) NOT NULL  
   , PRIMARY KEY (idMembres) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ImagesArticles
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ImagesArticles
 (
   idImagesArticles INTEGER NOT NULL AUTO_INCREMENT ,
   idArticles INTEGER NOT NULL  ,
   lienImagesArticles VARCHAR(128) NOT NULL  
   , PRIMARY KEY (idImagesArticles) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ImagesArticles
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ImagesArticles_Articles
     ON ImagesArticles (idArticles ASC);

# -----------------------------------------------------------------------------
#       TABLE : Events
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Events
 (
   idEvents INTEGER NOT NULL AUTO_INCREMENT ,
   titreEvents VARCHAR(64) NOT NULL  ,
   descEvents VARCHAR(7999) NOT NULL  ,
   dateEvents date NOT NULL  ,
   heureEvents TIME NOT NULL  ,
   lieuEvents CHAR(32) NOT NULL  
   , PRIMARY KEY (idEvents) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : LogActions
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LogActions
 (
   idLogActions INTEGER NOT NULL AUTO_INCREMENT ,
   idMembres INTEGER NOT NULL  ,
   codeLogActions INTEGER NOT NULL  ,
   dateLogActions dateTIME NOT NULL  ,
   descLogActions VARCHAR(256) NOT NULL  
   , PRIMARY KEY (idLogActions) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LogActions
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LogActions_Membres
     ON LogActions (idMembres ASC);

# -----------------------------------------------------------------------------
#       TABLE : Articles
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Articles
 (
   idArticles INTEGER NOT NULL AUTO_INCREMENT ,
   idMembres INTEGER NOT NULL  ,
   idcategoriesArticles INTEGER NOT NULL  ,
   titreArticles VARCHAR(128) NOT NULL  ,
   texteArticles VARCHAR(7999) NOT NULL  ,
   visibiliteArticles INTEGER NOT NULL  ,
   dateCreationArticles date NOT NULL  ,
   dateModificationArticles date NULL  
   , PRIMARY KEY (idArticles) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE Articles
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_Articles_Membres
     ON Articles (idMembres ASC);

CREATE  INDEX I_FK_Articles_categoriesArticles
     ON Articles (idcategoriesArticles ASC);

# -----------------------------------------------------------------------------
#       TABLE : CategoriesArticles
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CategoriesArticles
 (
   idCategoriesArticles INTEGER NOT NULL AUTO_INCREMENT ,
   titreCategoriesArticles VARCHAR(128) NOT NULL
   , PRIMARY KEY (idCategoriesArticles)
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ImagesGoodies
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ImagesGoodies
 (
   idImagesGoodies INTEGER NOT NULL AUTO_INCREMENT ,
   idGoodies INTEGER NOT NULL  ,
   lienImagesGoodies VARCHAR(128) NOT NULL  
   , PRIMARY KEY (idImagesGoodies) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ImagesGoodies
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ImagesGoodies_Goodies
     ON ImagesGoodies (idGoodies ASC);

# -----------------------------------------------------------------------------
#       TABLE : LiensPratiques
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LiensPratiques
 (
   idLiensPratiques INTEGER NOT NULL AUTO_INCREMENT ,
   titreLiensPratiques VARCHAR(128) NOT NULL  ,
   urlLiensPratiques VARCHAR(1024) NOT NULL
   , PRIMARY KEY (idLiensPratiques)
 )
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : Goodies
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS Goodies
 (
   idGoodies INTEGER NOT NULL AUTO_INCREMENT ,
   titreGoodies VARCHAR(64) NOT NULL  ,
   prixADGoodies DECIMAL(10,2) NOT NULL  ,
   prixNADGoodies DECIMAL(10,2) NOT NULL  ,
   descGoodies VARCHAR(7999) NOT NULL  ,
   categorieGoodies INTEGER NOT NULL  ,
   miniatureGoodies VARCHAR(128) NOT NULL  
   , PRIMARY KEY (idGoodies) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ArticlesYouTube
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ArticlesYouTube
 (
   idArticlesYouTube INTEGER NOT NULL AUTO_INCREMENT ,
   idcategoriesArticles INTEGER NOT NULL  ,
   idMembres INTEGER NOT NULL  ,
   titreArticlesYouTube VARCHAR(128) NOT NULL  ,
   texteArticlesYouTube VARCHAR(7999) NOT NULL  ,
   lienArticlesYouTube VARCHAR(256) NOT NULL  ,
   visibiliteArticlesYouTube INTEGER NOT NULL  ,
   dateCreationArticlesYouTube date NOT NULL  ,
   dateModificationArticlesYouTube date NULL  
   , PRIMARY KEY (idArticlesYouTube) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ArticlesYouTube
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ArticlesYouTube_categoriesArticles
     ON ArticlesYouTube (idcategoriesArticles ASC);

CREATE  INDEX I_FK_ArticlesYouTube_Membres
     ON ArticlesYouTube (idMembres ASC);


# -----------------------------------------------------------------------------
#       Creation DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE ImagesArticles 
  ADD FOREIGN KEY FK_ImagesArticles_Articles (idArticles)
      REFERENCES Articles (idArticles) ;


ALTER TABLE LogActions 
  ADD FOREIGN KEY FK_LogActions_Membres (idMembres)
      REFERENCES Membres (idMembres) ;


ALTER TABLE Articles 
  ADD FOREIGN KEY FK_Articles_Membres (idMembres)
      REFERENCES Membres (idMembres) ;


ALTER TABLE Articles 
  ADD FOREIGN KEY FK_Articles_categoriesArticles (idcategoriesArticles)
      REFERENCES categoriesArticles (idcategoriesArticles) ;


ALTER TABLE ImagesGoodies 
  ADD FOREIGN KEY FK_ImagesGoodies_Goodies (idGoodies)
      REFERENCES Goodies (idGoodies) ;


ALTER TABLE ArticlesYouTube 
  ADD FOREIGN KEY FK_ArticlesYouTube_categoriesArticles (idcategoriesArticles)
      REFERENCES categoriesArticles (idcategoriesArticles) ;


ALTER TABLE ArticlesYouTube 
  ADD FOREIGN KEY FK_ArticlesYouTube_Membres (idMembres)
      REFERENCES Membres (idMembres) ;

