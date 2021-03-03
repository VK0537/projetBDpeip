CREATE TABLE user(
        iduser Varchar(50) NOT NULL,
        fullname Text,
        firstname 
        email Varchar(100) NOT NULL,
        adress Text,
        CONSTRAINT user_PK PRIMARY KEY (iduser)
)ENGINE=InnoDB;

CREATE TABLE negatif(
        idnegatif  Int  Auto_increment  NOT NULL ,
        archiveref Varchar (50) NOT NULL ,
        stockref   Varchar (50) NOT NULL
	,CONSTRAINT negatif_PK PRIMARY KEY (idnegatif)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: auteur
#------------------------------------------------------------

CREATE TABLE auteur(
        idauteur Int  Auto_increment  NOT NULL ,
        nom      Text NOT NULL ,
        prenom   Text NOT NULL
	,CONSTRAINT auteur_PK PRIMARY KEY (idauteur)
)ENGINE=InnoDB;


CREATE TABLE photoghaphie(
        idphoto   Int  Auto_increment  NOT NULL ,
        date      Date NOT NULL ,
        legende   Text NOT NULL ,
        vignette  Numeric NOT NULL ,
        idnegatif Int ,
        idauteur  Int NOT NULL
	,CONSTRAINT photoghaphie_PK PRIMARY KEY (idphoto)

	,CONSTRAINT photoghaphie_negatif_FK FOREIGN KEY (idnegatif) REFERENCES negatif(idnegatif)
	,CONSTRAINT photoghaphie_auteur_FK  FOREIGN KEY (idauteur) REFERENCES auteur(idauteur)
)ENGINE=InnoDB;


CREATE TABLE imagenum(
        idimage    Int  Auto_increment  NOT NULL ,
        file       Varchar (50) NOT NULL ,
        path       Varchar (500) NOT NULL ,
        resolution Numeric NOT NULL ,
        idphoto    Int NOT NULL
	,CONSTRAINT imagenum_PK PRIMARY KEY (idimage)

	,CONSTRAINT imagenum_photoghaphie_FK FOREIGN KEY (idphoto) REFERENCES photoghaphie(idphoto)
	,CONSTRAINT imagenum_photoghaphie_AK UNIQUE (idphoto)
)ENGINE=InnoDB;


CREATE TABLE tirage(
        idtirage    Int  Auto_increment  NOT NULL ,
        archivereft Varchar (50) NOT NULL ,
        largeur     Numeric NOT NULL ,
        hauteur     Numeric NOT NULL ,
        idphoto     Int NOT NULL
	,CONSTRAINT tirage_PK PRIMARY KEY (idtirage)

	,CONSTRAINT tirage_photoghaphie_FK FOREIGN KEY (idphoto) REFERENCES photoghaphie(idphoto)
)ENGINE=InnoDB;


CREATE TABLE decrire(
        idphoto Int NOT NULL ,
        idmot   Varchar (50) NOT NULL,

        CONSTRAINT decrire_PK PRIMARY KEY (idphoto,idmot)

	,CONSTRAINT decrire_photoghaphie_FK FOREIGN KEY (idphoto) REFERENCES photoghaphie(idphoto)
	,CONSTRAINT decrire_motcle_FK       FOREIGN KEY (idmot) REFERENCES motcle(idmot)
)ENGINE=InnoDB;

