# Oblig 2 Databaser
# Marcus Nesvik Henriksen
# Jakob Irian Grønbeck

CREATE database jula;

CREATE TABLE produktListe
(
    artnr int(4) zerofill NOT NULL auto_increment,
    navn VARCHAR(50),
    pris DECIMAL(7,2),
    kategori CHAR(1),
    beskrivelse TEXT,
    antall INT,
    hylle VARCHAR(4),
    PRIMARY KEY (artnr),
    FOREIGN KEY (kategori) REFERENCES kategori(bokstav)
);

CREATE TABLE prishistorikk
(
	artnr INT(6),
    pris DECIMAL(7,2),
    dato DATE, -- Tiden prisen ble endret til denne verdien
    PRIMARY KEY (artnr),
    FOREIGN KEY (artnr) REFERENCES produktliste(artnr)
);

CREATE TABLE ordre
(
	ordrenr INT(7) ZEROFILL AUTO_INCREMENT,
    kundenr INT,
    dato DATE,
	betalingsmetode VARCHAR(20),
    sum INT,
    PRIMARY KEY (ordrenr),
    FOREIGN KEY (kundenr) REFERENCES medlem(kundenr)
);

CREATE TABLE ordrelinje
(
	ordrenr INT(7) ZEROFILL,
	artnr INT(6),
    pris DECIMAL(7,2),
    antall INT,
    PRIMARY KEY (ordrenr, artnr),
    FOREIGN KEY (ordrenr) REFERENCES ordre(ordrenr),
    FOREIGN KEY (artnr) REFERENCES produktliste(artnr)
);

CREATE TABLE medlem
(
	kundenr INT AUTO_INCREMENT,
    navn VARCHAR(50),
    adresse VARCHAR(50),
    postnr CHAR(4),
    epost VARCHAR(50),
    tlf VARCHAR(12),
    poeng INT,
    fødselsdato DATE,
    kommunikasjon BOOL, -- Får butikken lov å sende ut markedsføring
    
    #Faktura medlem, valgfritt
    julasmart BOOL,
	kredrittGrense INT,
    fødselsnr CHAR(11),
    
    PRIMARY KEY (kundenr, epost, tlf),
    FOREIGN KEY (postnr) REFERENCES poststed(postNr)
);


CREATE TABLE poststed
(
  postnr CHAR(4),
  stedsnavn VARCHAR(50) NOT NULL,
  PRIMARY KEY (postnr)
);


CREATE TABLE ansatt
(
	ansattnr INT AUTO_INCREMENT,
    tlf VARCHAR(12),
	navn VARCHAR(50),
    adresse VARCHAR(50),
    epost VARCHAR(50),
    fødselsdato DATE,
    ansettelsesdato DATE,
    kontrakt VARCHAR(20),
    PRIMARY KEY (ansattnr),
    FOREIGN KEY (tlf) REFERENCES medlem(tlf)
);

CREATE TABLE mottak
(
	mottaksnr INT AUTO_INCREMENT,
    sumvarer INT,
    dato DATE,
    PRIMARY KEY (mottaksnr)
);

CREATE TABLE mottaklinje
(
	mottaksnr INT AUTO_INCREMENT,
	artnr INT(6),
    antall INT,
    PRIMARY KEY (mottaksnr, artnr),
    FOREIGN KEY (mottaksnr) REFERENCES mottak(mottaksnr)
);

CREATE TABLE service
(
	servicenr INT AUTO_INCREMENT,
	dato DATE,
    type VARCHAR(20),
    beskrivelse TEXT,
    sum INT,
    PRIMARY KEY (servicenr)
);

CREATE TABLE servicelinje
(
	servicenr INT AUTO_INCREMENT,
	artnr INT(6),
    navn VARCHAR(20),
    antall INT,
    pris DECIMAL(7,2),
    PRIMARY KEY (servicenr, artnr),
    FOREIGN KEY (servicenr) REFERENCES service(servicenr),
    FOREIGN KEY (artnr) REFERENCES produktliste(artnr)
);

CREATE TABLE kategori
(
	bokstav CHAR(1),
	navn VARCHAR(30),
    PRIMARY KEY (bokstav)
);