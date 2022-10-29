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

SELECT Bokstav FROM kategori;

ALTER TABLE kategori RENAME COLUMN Bokstav TO bokstav;

ALTER TABLE kategori CHANGE Bokstav bokstav char(1);

ALTER TABLE produktliste MODIFY Kategori char(1);

ALTER TABLE produktliste

select CONSTRAINT_NAME
from INFORMATION_SCHEMA.TABLE_CONSTRAINTS
where TABLE_NAME = 'produktliste';

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
WHERE TABLE_NAME =  'produktliste'
AND COLUMN_NAME =  'Kategori';

ALTER TABLE produktliste
ADD FOREIGN KEY (Kategori) REFERENCES Kategori(bokstav);

SELECT * FROM Produktliste ORDER BY ArtNr DESC LIMIT 1;


INSERT INTO mottak (SumVarer, Dato) VALUES (1000, '1000-01-01'),
                                           (2499, '2052-01-01'),
                                           (4499, '2062-01-01'),
                                           (66499, '2072-01-01');

SELECT * FROM produktliste;

SELECT * FROM ProduktListe;