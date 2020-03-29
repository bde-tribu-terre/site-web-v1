DROP DATABASE IF EXISTS TRIBUTERRE;

CREATE DATABASE IF NOT EXISTS TRIBUTERRE;
USE TRIBUTERRE;
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
#       TABLE : JOURNAUX
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS JOURNAUX
 (
   IDJOURNAL INTEGER NOT NULL AUTO_INCREMENT  ,
   TITREJOURNAL VARCHAR(64) NOT NULL  ,
   DATEJOURNAL DATE NOT NULL  ,
   PDFJOURNAL VARCHAR(128) NOT NULL  
   , PRIMARY KEY (IDJOURNAL) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : EVENTS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EVENTS
 (
   IDEVENTS INTEGER NOT NULL AUTO_INCREMENT  ,
   TITREEVENTS VARCHAR(64) NOT NULL  ,
   DESCEVENTS VARCHAR(7999) NOT NULL  ,
   DATEEVENTS DATE NOT NULL  ,
   HEUREEVENTS TIME NOT NULL  ,
   LIEUEVENTS CHAR(32) NOT NULL  
   , PRIMARY KEY (IDEVENTS) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : IMAGESCUISINE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS IMAGESCUISINE
 (
   IDIMAGESCUISINE INTEGER NOT NULL AUTO_INCREMENT  ,
   IDCUISINE INTEGER NOT NULL  ,
   LIENIMAGESCUISINE VARCHAR(128) NOT NULL  
   , PRIMARY KEY (IDIMAGESCUISINE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE IMAGESCUISINE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_IMAGESCUISINE_CUISINE
     ON IMAGESCUISINE (IDCUISINE ASC);

# -----------------------------------------------------------------------------
#       TABLE : IMAGESGOODIES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS IMAGESGOODIES
 (
   IDIMAGESGOODIES INTEGER NOT NULL AUTO_INCREMENT  ,
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
#       TABLE : CUISINE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CUISINE
 (
   IDCUISINE INTEGER NOT NULL AUTO_INCREMENT  ,
   TITRECUISINE VARCHAR(128) NOT NULL  ,
   ESTVIDEOCUISINE INTEGER NOT NULL  ,
   LIENYTCUISINE VARCHAR(128) NOT NULL  ,
   DESCCUISINE VARCHAR(7999) NOT NULL  
   , PRIMARY KEY (IDCUISINE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : GOODIES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS GOODIES
 (
   IDGOODIES INTEGER NOT NULL AUTO_INCREMENT  ,
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


ALTER TABLE IMAGESCUISINE 
  ADD FOREIGN KEY FK_IMAGESCUISINE_CUISINE (IDCUISINE)
      REFERENCES CUISINE (IDCUISINE) ;


ALTER TABLE IMAGESGOODIES 
  ADD FOREIGN KEY FK_IMAGESGOODIES_GOODIES (IDGOODIES)
      REFERENCES GOODIES (IDGOODIES) ;

