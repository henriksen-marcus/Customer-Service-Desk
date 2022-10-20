# Oblig 2 Databaser
# Marcus Nesvik Henriksen
# Jakob Irian Grønbeck

CREATE database Jula;

CREATE TABLE ProduktListe 
(
    ArtNr INT AUTO_INCREMENT,
    Navn VARCHAR(50),
    Pris DECIMAL(5,2),
    Kategori INT,
    Beskrivelse VARCHAR(20),
    Antall INT, 
    Hylle VARCHAR(4),
    PRIMARY KEY (ArtNr),
    FOREIGN KEY (Kategori) REFERENCES Kategori(KatNr)
);

CREATE TABLE Kategori
(
	KatNr INT AUTO_INCREMENT,
    Navn VARCHAR(30),
    PRIMARY KEY (KatNr)
);

CREATE TABLE PrisHistorikk 
(
	ArtNr INT,
    Pris DECIMAL(5,2),
    Dato DATE, -- Tiden prisen ble endret til denne verdien
    PRIMARY KEY (ArtNr),
    FOREIGN KEY (ArtNr) REFERENCES ProduktListe(ArtNr)
);

CREATE TABLE Ordre 
(
	OrdreNr INT,
    KundeNr INT,
	Ordrelinje INT,
    Dato DATE,
	Betalingsmetode VARCHAR(20),
    Sum INT,
    PRIMARY KEY (OrdreNr),
    FOREIGN KEY (KundeNr) REFERENCES Medlem(KundeNr)
);

CREATE TABLE Ordrelinje 
(
	OrdreNr INT,
	ArtNr INT,
    Navn VARCHAR(20),
    Pris DECIMAL(5,2),
    Antall INT,
    PRIMARY KEY (OrdreNr, ArtNr),
    FOREIGN KEY (OrdreNr) REFERENCES Ordre(OrdreNr),
    FOREIGN KEY (ArtNr) REFERENCES ProduktListe(ArtNr)
);

CREATE TABLE Medlem 
(
	KundeNr INT,
    Navn VARCHAR(50),
    Adresse VARCHAR(50),
    PostNr CHAR(4),
    Epost VARCHAR(50),
    Tlf VARCHAR(12),
    Poeng INT,
    Fødselsdato DATE,
    Kommunikasjon BOOL, -- Får butikken lov å sende ut markedsføring
    
    #Faktura medlem, valgfritt
    JulaSmart BOOL,
	KredrittGrense INT,
    Fødselsnr CHAR(11),
    
    PRIMARY KEY (KundeNr, Epost, Tlf),
    FOREIGN KEY (PostNr) REFERENCES PostSted(PostNr)
);


CREATE TABLE Poststed
(
  PostNr CHAR(4),
  Poststed VARCHAR(50) NOT NULL,
  PRIMARY KEY (PostNr)
);


CREATE TABLE Ansatt 
(
	AnsattNr INT,
    Tlf VARCHAR(12),
	Navn VARCHAR(50),
    Adresse VARCHAR(50),
    Epost VARCHAR(50),
    Fødselsdato DATE,
    AnsettelsesDato DATE,
    Kontrakt VARCHAR(20),
    PRIMARY KEY (AnsattNr),
    FOREIGN KEY (Tlf) REFERENCES Medlem(Tlf)
);

CREATE TABLE Mottak 
(
	Mottaklinje INT,
    SumVarer INT,
    Dato DATE
);

CREATE TABLE Mottaklinje 
(
	ArtNr INT,
    Navn VARCHAR(20),
    Antall INT
);

CREATE TABLE Service 
(
	ServiceNr INT AUTO_INCREMENT,
	Dato DATE,
    Type VARCHAR(20),
    Beskrivelse VARCHAR(1000),
    Sum INT,
    PRIMARY KEY (ServiceNr)
);

CREATE TABLE Servicelinje 
(
	ArtNr INT,
    Navn VARCHAR(20),
    Antall INT,
    Pris DECIMAL
);

CREATE TABLE Kategori 
(
	Navn VARCHAR(20),
    Nr INT
);