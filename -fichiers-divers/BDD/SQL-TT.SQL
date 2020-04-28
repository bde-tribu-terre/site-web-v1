DROP DATABASE IF EXISTS TRIBUTERRE;

CREATE DATABASE IF NOT EXISTS TRIBUTERRE;
USE TRIBUTERRE;
# -----------------------------------------------------------------------------
#       TABLE : JOURNAUX
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS JOURNAUX
 (
   IDJOURNAUX INTEGER NOT NULL AUTO_INCREMENT ,
   TITREJOURNAUX VARCHAR(64) NOT NULL  ,
   DATEJOURNAUX DATE NOT NULL  ,
   PDFJOURNAUX VARCHAR(128) NOT NULL  
   , PRIMARY KEY (IDJOURNAUX) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CLESINSCRIPTIONS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CLESINSCRIPTIONS
 (
   IDCLESINSCRIPTIONS INTEGER NOT NULL AUTO_INCREMENT  ,
   STRCLESINSCRIPITIONS VARCHAR(128) NOT NULL  
   , PRIMARY KEY (IDCLESINSCRIPTIONS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : MEMBRES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MEMBRES
 (
   IDMEMBRES INTEGER NOT NULL AUTO_INCREMENT ,
   LOGINMEMBRES VARCHAR(64) NOT NULL  ,
   MDPHASHMEMBRES VARCHAR(128) NOT NULL  ,
   MDPSALTMEMBRES VARCHAR(32) NOT NULL  ,
   PRENOMMEMBRES VARCHAR(64) NOT NULL  ,
   NOMMEMBRES VARCHAR(64) NOT NULL  
   , PRIMARY KEY (IDMEMBRES) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : IMAGESARTICLES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS IMAGESARTICLES
 (
   IDIMAGESARTICLES INTEGER NOT NULL AUTO_INCREMENT ,
   IDARTICLES INTEGER NOT NULL  ,
   LIENIMAGESARTICLES VARCHAR(128) NOT NULL  
   , PRIMARY KEY (IDIMAGESARTICLES) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE IMAGESARTICLES
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_IMAGESARTICLES_ARTICLES
     ON IMAGESARTICLES (IDARTICLES ASC);

# -----------------------------------------------------------------------------
#       TABLE : EVENTS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EVENTS
 (
   IDEVENTS INTEGER NOT NULL AUTO_INCREMENT ,
   TITREEVENTS VARCHAR(64) NOT NULL  ,
   DESCEVENTS VARCHAR(7999) NOT NULL  ,
   DATEEVENTS DATE NOT NULL  ,
   HEUREEVENTS TIME NOT NULL  ,
   LIEUEVENTS CHAR(32) NOT NULL  
   , PRIMARY KEY (IDEVENTS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : LOGACTIONS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LOGACTIONS
 (
   IDLOGACTIONS INTEGER NOT NULL AUTO_INCREMENT ,
   IDMEMBRES INTEGER NOT NULL  ,
   CODELOGACTIONS INTEGER NOT NULL  ,
   DATELOGACTIONS DATETIME NOT NULL  ,
   DESCLOGACTIONS VARCHAR(256) NOT NULL  
   , PRIMARY KEY (IDLOGACTIONS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LOGACTIONS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LOGACTIONS_MEMBRES
     ON LOGACTIONS (IDMEMBRES ASC);

# -----------------------------------------------------------------------------
#       TABLE : ARTICLES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ARTICLES
 (
   IDARTICLES INTEGER NOT NULL AUTO_INCREMENT ,
   IDMEMBRES INTEGER NOT NULL  ,
   IDCATEGORIESARTICLES INTEGER NOT NULL  ,
   TITREARTICLES VARCHAR(128) NOT NULL  ,
   TEXTEARTICLES VARCHAR(7999) NOT NULL  ,
   VISIBILITEARTICLES INTEGER NOT NULL  ,
   DATECREATIONARTICLES DATE NOT NULL  ,
   DATEMODIFICATIONARTICLES DATE NULL  
   , PRIMARY KEY (IDARTICLES) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ARTICLES
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ARTICLES_MEMBRES
     ON ARTICLES (IDMEMBRES ASC);

CREATE  INDEX I_FK_ARTICLES_CATEGORIESARTICLES
     ON ARTICLES (IDCATEGORIESARTICLES ASC);

# -----------------------------------------------------------------------------
#       TABLE : CATEGORIESARTICLES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATEGORIESARTICLES
 (
   IDCATEGORIESARTICLES INTEGER NOT NULL AUTO_INCREMENT ,
   TITRECATEGORIESARTICLES VARCHAR(128) NOT NULL  
   , PRIMARY KEY (IDCATEGORIESARTICLES) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : IMAGESGOODIES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS IMAGESGOODIES
 (
   IDIMAGESGOODIES INTEGER NOT NULL AUTO_INCREMENT ,
   IDGOODIES INTEGER NOT NULL  ,
   LIENIMAGESGOODIES VARCHAR(128) NOT NULL  
   , PRIMARY KEY (IDIMAGESGOODIES) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE IMAGESGOODIES
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_IMAGESGOODIES_GOODIES
     ON IMAGESGOODIES (IDGOODIES ASC);

# -----------------------------------------------------------------------------
#       TABLE : GOODIES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS GOODIES
 (
   IDGOODIES INTEGER NOT NULL AUTO_INCREMENT ,
   TITREGOODIES VARCHAR(64) NOT NULL  ,
   PRIXADGOODIES DECIMAL(10,2) NOT NULL  ,
   PRIXNADGOODIES DECIMAL(10,2) NOT NULL  ,
   DESCGOODIES VARCHAR(7999) NOT NULL  ,
   CATEGORIEGOODIES INTEGER NOT NULL  ,
   MINIATUREGOODIES VARCHAR(128) NOT NULL  
   , PRIMARY KEY (IDGOODIES) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ARTICLESYOUTUBE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ARTICLESYOUTUBE
 (
   IDARTICLESYOUTUBE INTEGER NOT NULL AUTO_INCREMENT ,
   IDCATEGORIESARTICLES INTEGER NOT NULL  ,
   IDMEMBRES INTEGER NOT NULL  ,
   TITREARTICLESYOUTUBE VARCHAR(128) NOT NULL  ,
   TEXTEARTICLESYOUTUBE VARCHAR(7999) NOT NULL  ,
   LIENARTICLESYOUTUBE VARCHAR(256) NOT NULL  ,
   VISIBILITEARTICLESYOUTUBE INTEGER NOT NULL  ,
   DATECREATIONARTICLESYOUTUBE DATE NOT NULL  ,
   DATEMODIFICATIONARTICLESYOUTUBE DATE NULL  
   , PRIMARY KEY (IDARTICLESYOUTUBE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ARTICLESYOUTUBE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ARTICLESYOUTUBE_CATEGORIESARTICLES
     ON ARTICLESYOUTUBE (IDCATEGORIESARTICLES ASC);

CREATE  INDEX I_FK_ARTICLESYOUTUBE_MEMBRES
     ON ARTICLESYOUTUBE (IDMEMBRES ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE IMAGESARTICLES 
  ADD FOREIGN KEY FK_IMAGESARTICLES_ARTICLES (IDARTICLES)
      REFERENCES ARTICLES (IDARTICLES) ;


ALTER TABLE LOGACTIONS 
  ADD FOREIGN KEY FK_LOGACTIONS_MEMBRES (IDMEMBRES)
      REFERENCES MEMBRES (IDMEMBRES) ;


ALTER TABLE ARTICLES 
  ADD FOREIGN KEY FK_ARTICLES_MEMBRES (IDMEMBRES)
      REFERENCES MEMBRES (IDMEMBRES) ;


ALTER TABLE ARTICLES 
  ADD FOREIGN KEY FK_ARTICLES_CATEGORIESARTICLES (IDCATEGORIESARTICLES)
      REFERENCES CATEGORIESARTICLES (IDCATEGORIESARTICLES) ;


ALTER TABLE IMAGESGOODIES 
  ADD FOREIGN KEY FK_IMAGESGOODIES_GOODIES (IDGOODIES)
      REFERENCES GOODIES (IDGOODIES) ;


ALTER TABLE ARTICLESYOUTUBE 
  ADD FOREIGN KEY FK_ARTICLESYOUTUBE_CATEGORIESARTICLES (IDCATEGORIESARTICLES)
      REFERENCES CATEGORIESARTICLES (IDCATEGORIESARTICLES) ;


ALTER TABLE ARTICLESYOUTUBE 
  ADD FOREIGN KEY FK_ARTICLESYOUTUBE_MEMBRES (IDMEMBRES)
      REFERENCES MEMBRES (IDMEMBRES) ;

