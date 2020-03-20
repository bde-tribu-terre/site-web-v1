DROP DATABASE IF EXISTS TRIBUTERRE;

CREATE DATABASE IF NOT EXISTS TRIBUTERRE;;
USE TRIBUTERRE;;
# -----------------------------------------------------------------------------
#       TABLE : MEMBRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MEMBRE
 (
   IDMEMBRE INTEGER NOT NULL AUTO_INCREMENT  ,
   LOGINMEMBRE VARCHAR(64) NOT NULL  ,
   MDPMEMBRE VARCHAR(64) NOT NULL  ,
   NOMMEMBRE VARCHAR(64) NOT NULL  ,
   DESCMEMBRE VARCHAR(1024) NOT NULL  
   , PRIMARY KEY (IDMEMBRE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : EVENTS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EVENTS
 (
   IDEVENTS INTEGER NOT NULL AUTO_INCREMENT  ,
   TITREEVENTS VARCHAR(64) NOT NULL  ,
   DESCEVENTS VARCHAR(128) NOT NULL  ,
   TEXTEEVENTS VARCHAR(32768) NOT NULL  ,
   DATEDEBUTEVENTS DATETIME NOT NULL  ,
   DATEFINEVENTS DATETIME NOT NULL  ,
   ESTUNEDUREEEVENTS SMALLINT NOT NULL  ,
   HEUREDEFINIEEVENTS SMALLINT NOT NULL  ,
   LIEUEVENTS CHAR(32) NOT NULL  
   , PRIMARY KEY (IDEVENTS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ARTICLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ARTICLE
 (
   IDARTICLE INTEGER NOT NULL AUTO_INCREMENT  ,
   IDMEMBRE INTEGER NOT NULL  ,
   TITREARTICLE VARCHAR(64) NOT NULL  ,
   DESCARTICLE VARCHAR(128) NOT NULL  ,
   TEXTEARTICLE VARCHAR(32768) NOT NULL  ,
   DATEPUBLIARTICLE DATETIME NOT NULL  
   , PRIMARY KEY (IDARTICLE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ARTICLE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ARTICLE_MEMBRE
     ON ARTICLE (IDMEMBRE ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE ARTICLE 
  ADD FOREIGN KEY FK_ARTICLE_MEMBRE (IDMEMBRE)
      REFERENCES MEMBRE (IDMEMBRE) ;

