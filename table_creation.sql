# Oblig 2 Databaser
# Marcus Nesvik Henriksen
# Jakob Irian Grønbeck

CREATE database Jula;

CREATE TABLE ProduktListe (
    ArtNr INT,
    Navn VARCHAR(20),
    Pris DECIMAL,
    Kategori VARCHAR(20),
    Beskrivelse VARCHAR(20),
    Antall INT, 
    Hylle VARCHAR(4)
);

CREATE TABLE PrisHistorikk (
	ArtNr INT,
    Pris DECIMAL,
    Dato DATE
);

CREATE TABLE Ordre (
	Ordrelinje INT,
    Dato DATE,
	Betalingsmetode VARCHAR(20),
    Sum INT,
    Medlem VARCHAR(5)
);

CREATE TABLE Ordrelinje (
	ArtNr INT,
    Navn VARCHAR(20),
    Pris DECIMAL,
    Antall INT
);

CREATE TABLE Medlem (
	KundeNr INT,
    Navn VARCHAR(20),
    Adresse VARCHAR(20),
    Epost VARCHAR(20),
    Tlf INT,
    Fødselsdato DATE,
    Godkjent_kommunikasjon VARCHAR(3)
);


CREATE TABLE Ansatt (
	Navn VARCHAR(20),
    Adresse VARCHAR(20),
    Epost VARCHAR(20),
    Tlf INT,
    Fødselsdato DATE,
    AnsattNr INT,
    AnsettelsesDato DATE,
    Kontrakt VARCHAR(20)
);

CREATE TABLE Mottak (
	Mottaklinje INT,
    SumVarer INT,
    Dato DATE
);

CREATE TABLE Mottaklinje (
	ArtNr INT,
    Navn VARCHAR(20),
    Antall INT
);

CREATE TABLE Service (
	Dato DATE,
    _Type VARCHAR(20),
    Beskrivelse VARCHAR(20),
    Sum INT
);

CREATE TABLE Servicelinje (
	ArtNr INT,
    Navn VARCHAR(20),
    Antall INT,
    Pris DECIMAL
);

CREATE TABLE Kategori (
	Navn VARCHAR(20),
    Nr INT
);