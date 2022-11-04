-- Oppdaterer et produkt sitt navn og pris
DELIMITER //
USE jula //
CREATE PROCEDURE jula.upd_product (IN artnr INT(6), IN navn VARCHAR(50), IN pris DECIMAL(7,2))
BEGIN
UPDATE produktliste p SET p.navn = navn, p.pris = pris
WHERE p.artnr = artnr;

SELECT * FROM produktliste p WHERE p.artnr = artnr;
END //
DELIMITER ;


-- Skaffer informasjon i kundens perspektiv
DELIMITER //
USE jula //
CREATE PROCEDURE jula.getproducts ()
BEGIN

SELECT navn, pris FROM produktliste;

END //
DELIMITER ;



CALL upd_product(1, 'Verktøysett 14 deler', 499);

CALL getproducts();