DROP DATABASE IF EXISTS TRIBUTERRE;

CREATE DATABASE IF NOT EXISTS TRIBUTERRE;
USE TRIBUTERRE;
# -----------------------------------------------------------------------------
#       TABLE : MEMBRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MEMBRE
 (
   IDMEMBRE INTEGER NOT NULL AUTO_INCREMENT ,
   LOGINMEMBRE VARCHAR(64) NOT NULL  ,
   MDPMEMBRE VARCHAR(64) NOT NULL  ,
   NOMMEMBRE VARCHAR(64) NOT NULL  ,
   DESCMEMBRE VARCHAR(1024) NOT NULL  
   , PRIMARY KEY (IDMEMBRE) 
 ) 
 comment = "";

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
   IDMEMBRE INTEGER NOT NULL  ,
   CODELOGACTIONS INTEGER NOT NULL  ,
   DATELOGACTIONS DATETIME NOT NULL  ,
   DESCLOGACTIONS VARCHAR(256) NOT NULL  
   , PRIMARY KEY (IDLOGACTIONS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE LOGACTIONS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_LOGACTIONS_MEMBRE
     ON LOGACTIONS (IDMEMBRE ASC);

# -----------------------------------------------------------------------------
#       TABLE : ARTICLES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ARTICLES
 (
   IDARTICLES INTEGER NOT NULL AUTO_INCREMENT ,
   TITREARTICLES VARCHAR(128) NOT NULL  ,
   TEXTEARTICLES VARCHAR(7999) NOT NULL  ,
   CATEGORIEARTICLES INTEGER NOT NULL  ,
   VISIBILITEARTICLES INTEGER NOT NULL  
   , PRIMARY KEY (IDARTICLES) 
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
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE IMAGESARTICLES 
  ADD FOREIGN KEY FK_IMAGESARTICLES_ARTICLES (IDARTICLES)
      REFERENCES ARTICLES (IDARTICLES) ;


ALTER TABLE LOGACTIONS 
  ADD FOREIGN KEY FK_LOGACTIONS_MEMBRE (IDMEMBRE)
      REFERENCES MEMBRE (IDMEMBRE) ;


ALTER TABLE IMAGESGOODIES 
  ADD FOREIGN KEY FK_IMAGESGOODIES_GOODIES (IDGOODIES)
      REFERENCES GOODIES (IDGOODIES) ;

