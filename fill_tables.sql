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

INSERT INTO mottak (SumVarer, Dato) VALUES (1000, '1000-01-01'),
                                           (2499, '2052-01-01'),
                                           (4499, '2062-01-01'),
                                           (66499, '2072-01-01');