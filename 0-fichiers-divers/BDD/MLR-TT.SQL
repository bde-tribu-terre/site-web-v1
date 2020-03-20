DROP DATABASE IF EXISTS MLR-TT;

CREATE DATABASE IF NOT EXISTS MLR-TT;
USE MLR-TT;
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
   DATEEVENTS DATE NOT NULL  ,
   HEUREEVENTS TIME NOT NULL  ,
   LIEUEVENTS CHAR(32) NOT NULL  
   , PRIMARY KEY (IDEVENTS) 
 ) 
 comment = "";


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------

