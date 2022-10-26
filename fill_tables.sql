INSERT INTO ProduktListe (Navn, Pris, Kategori, Beskrivelse, Antall, Hylle)
  VALUES ('Verktøysett', 349, 1, 'Verktøysett med 14 deler, alt du trenger til hjemmefiksen.', 5, 'A12');

INSERT INTO ProduktListe (Navn, Pris, Kategori, Beskrivelse, Antall, Hylle)
  VALUES ('Ryobi 2Ah Skrutrekker', 1299, 1, 'Kraftig skrutrekker med god kapasitet.', 2, 'A49');

ALTER TABLE produktliste MODIFY Beskrivelse TEXT;

ALTER TABLE produktliste MODIFY pris DECIMAL(7,2);

SELECT * FROM produktliste;


SELECT * FROM Kategori;

TRUNCATE TABLE Kategori;

INSERT INTO kategori (Navn) VALUES ('Verktøy og maskiner');

ALTER TABLE kategori MODIFY navn VARCHAR(40);
ALTER TABLE kategori ADD COLUMN Bokstav char(1) NOT NULL;
ALTER TABLE kategori MODIFY KatNr INT(2);
ALTER TABLE kategori DROP PRIMARY KEY;
ALTER TABLE kategori ADD PRIMARY KEY (Bokstav);
ALTER TABLE kategori DROP COLUMN KatNr;
ALTER TABLE kategori MODIFY Navn VARCHAR(40) NOT NULL;

INSERT INTO kategori (Bokstav, Navn) VALUES
        ('A', 'Verktøy og maskiner'),
        ('B', 'Bygg og maling'),
        ('C','El-artikler og belysning'),
        ('D', 'Klær og verneutstyr'),
        ('E', 'Hage'),
        ('F', 'Fritid'),
        ('G', 'Bil og garasje'),
        ('H', 'Hjem og husholdning');


SELECT Navn FROM kategori;

SELECT Bokstav FROM kategori