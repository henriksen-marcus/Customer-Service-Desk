# Oblig 2 Databaser
# Marcus Nesvik Henriksen
# Jakob Irian Grønbeck

INSERT INTO ProduktListe (Navn, Pris, Kategori, Beskrivelse, Antall, Hylle) VALUES
    ('Verktøysett', 349, 'A', 'Verktøysett med 14 deler, alt du trenger til hjemmefiksen.', 5, 'A12'),
    ('Ryobi 2Ah Skrutrekker', 1299, 'A', 'Kraftig skrutrekker med god kapasitet.', 2, 'A49'),
    ('Bacho Hammer', 249.90, 'A', 'Hammer av høy kvalitet laget av Bahco.', 20, 'A12'),
    ('Gressklipper Meec 18V', 3999.90, 'E', 'Batteridreven gressklipper som gjør din plen plenen penere en naboen.', 5, 'E82');


INSERT INTO kategori (Bokstav, Navn) VALUES
        ('A', 'Verktøy og maskiner'),
        ('B', 'Bygg og maling'),
        ('C','El-artikler og belysning'),
        ('D', 'Klær og verneutstyr'),
        ('E', 'Hage'),
        ('F', 'Fritid'),
        ('G', 'Bil og garasje'),
        ('H', 'Hjem og husholdning');

INSERT INTO mottak (SumVarer, Dato) VALUES (19400.20, '2020-01-28'),
                                           (24290.80, '2020-02-25'),
                                           (5200, '2020-06-02'),
                                           (62700, '2021-01-02');

INSERT INTO mottaklinje VALUES (1,000001,20),
                               (1,000002, 40),
                               (1,000003,5),
                               (2,000002, 15),
                               (2,000004,2);

INSERT INTO ordre (betalingsmetode) VALUES ('Bankaxept');

INSERT INTO ordre (kundenr, betalingsmetode) VALUES (1,'Bankaxept');

INSERT INTO ordrelinje (ordrenr, artnr, pris, antall) VALUES (1, 1, 200, 2),
                                                             (1, 4, 3200, 1),
                                                             (3, 2, 400, 5),
                                                             (3, 1, 200, 1);

INSERT INTO medlem (navn, epost, tlf, poeng, fødselsdato, kommunikasjon, julasmart, kredrittgrense) VALUES ('Marcus Henriksen', 'marcus.henriksen@live.no', 96621643, 0, '2000-05-15', false, true, 15000),
                                                                                                           ('Jacob Grønbeck', 'jacob133@gmail.com', 47478232, 0, '2002-02-02', true, false, 0);

