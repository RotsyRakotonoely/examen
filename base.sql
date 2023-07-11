DROP DATABASE IF EXISTS regime;
CREATE DATABASE regime;
USE regime;

CREATE TABLE users (
  iduser INT(11) AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(50) NOT NULL,
  mdp VARCHAR(255) NOT NULL,
  nom VARCHAR(100),
  genre VARCHAR(20),
  taille DECIMAL(4,2),
  poids DECIMAL(4,2),
  portefeuille INT NOT NULL DEFAULT 0
);

INSERT INTO users (email, mdp, nom, genre, taille, poids, portefeuille) VALUES
('admin', 'admin', 'admin', 'Homme', NULL, NULL, 0),
('koto@gmail.com', 'koto', 'Koto', 'Homme', 1.70, 70, 0),
('Feno@gmail.com', 'Feno', 'Feno', 'Homme', 1.75, 75, 0),
('lisa@gmail.com', 'lisa', 'Lisa', 'Femme', 1.60, 55, 0),
('john@gmail.com', 'john', 'John', 'Homme', 1.80, 80, 0);

CREATE TABLE portefeuille (
    idPortefeuille INT AUTO_INCREMENT NOT NULL,
    iduser INT NOT NULL,
    montant INT DEFAULT 0,
    PRIMARY KEY (idPortefeuille),
    FOREIGN KEY (iduser) REFERENCES users (iduser)
);

CREATE TABLE code (
    idCode INT AUTO_INCREMENT NOT NULL,
    code INT(50),
    valeur INT(40),
    utilise TINYINT(1) NOT NULL DEFAULT 0,
    idPortefeuille INT,
    PRIMARY KEY (idCode),
    FOREIGN KEY (idPortefeuille) REFERENCES portefeuille (idPortefeuille)
);

CREATE TABLE sakafo(
    idSakafo INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(100),
    Prix INT
);

CREATE TABLE Objectif (
    idobjectifs INT AUTO_INCREMENT NOT NULL,
    nomObj VARCHAR(50),
    PRIMARY KEY (idobjectifs)
);

INSERT INTO Objectif (nomObj) VALUES
('Gain de poids'),
('Perte de poids');

CREATE TABLE Sport(
    idSport INT PRIMARY KEY AUTO_INCREMENT,
    Nom VARCHAR(100)
);

INSERT INTO Sport (Nom) VALUES
('vélo'),
('natation'),
('danse cardio'),
('Sport de combat'),
('musculation');

INSERT INTO sakafo (Nom, Prix) VALUES
('Légumes non féculents', 20000),
('Fruits à faible teneur en sucre', 30000),
('Viandes maigres', 40000),
('Produits laitiers faibles en matières grasses', 30000),
('Nuggets de poulet', 60000),
('Fast food', 20000),
('Confiseries', 30000),
('Produits de boulangerie et viennoiseries', 30000);

INSERT INTO code (code, valeur, utilise)
VALUES
(13585, 20000, 0),
(12219, 10000, 0),
(24680, 15000, 0),
(98765, 25000, 0),
(54321, 5000, 0),
(11111, 30000, 0),
(22222, 7000, 0),
(33333, 12000, 0),
(44444, 18000, 0),
(55555, 9000, 0),
(66666, 6000, 0),
(77777, 15000, 0),
(88888, 25000, 0),
(99999, 10000, 0),
(12345, 5000, 0);



CREATE TABLE SportObjectif(
    idSportObjectif INT PRIMARY KEY AUTO_INCREMENT,
    idSakafo INT,
    idObjectif INT,
    genre VARCHAR(100),
    FOREIGN KEY (idSakafo) REFERENCES sakafo(idSakafo),
    FOREIGN KEY (idObjectif) REFERENCES Objectif(idobjectifs)
);

CREATE TABLE SuiviRegime(
    idSuiviRegime INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT,
    duree INT,
    FOREIGN KEY (idUser) REFERENCES users(iduser)
);

CREATE TABLE RegimeObjectif (
    idRegimeObjectif INT PRIMARY KEY AUTO_INCREMENT,
    idSakafo INT,
    idObjectif INT,
    genre VARCHAR(100),
    FOREIGN KEY (idSakafo) REFERENCES sakafo(idSakafo),
    FOREIGN KEY (idObjectif) REFERENCES Objectif(idobjectifs)
);
INSERT INTO SportObjectif (idSportObjectif, idSakafo, idObjectif, genre) VALUES
(1, 1, 1, 'femme'),
(2, 2, 1, 'homme'),
(3, 3, 1, 'femme'),
(4, 4, 2, 'homme'),
(5, 5, 2, 'homme'),
(6, 6, 1, 'femme'),
(7, 7, 2, 'homme'),
(8, 8, 2, 'femme');


INSERT INTO RegimeObjectif (idRegimeObjectif, idSakafo, idObjectif, genre) VALUES
(1, 1, 1, 'femme'),
(2, 2, 1, 'homme'),
(3, 3, 1, 'femme'),
(4, 4, 2, 'homme'),
(5, 5, 2, 'homme');
CREATE TABLE VariationPoids (
    idVariation INT AUTO_INCREMENT PRIMARY KEY,
    idSakafo INT,
    idSport INT,
    variation INT,
    objectif ENUM('perte', 'gain'),
    duree INT,
    FOREIGN KEY (idSakafo) REFERENCES sakafo(idSakafo),
    FOREIGN KEY (idSport) REFERENCES Sport(idSport)
);

INSERT INTO VariationPoids (idSakafo, idSport, variation, objectif, duree) VALUES
(1, 1, -3, 'perte', 30),
(2, 3, -6, 'perte', 60),
(3, 2, -8, 'perte', 90),
(4, 2, -10, 'perte', 120),
(5, 4, 3, 'gain', 30),
(6, 4, 6, 'gain', 60),
(7, 5, 8, 'gain', 90),
(8, 5, 10, 'gain', 120);


CREATE OR REPLACE VIEW VariationPoidsAvecNoms AS
SELECT vp.idVariation, s.Nom AS NomSakafo, sp.Nom AS NomSport, vp.variation, vp.objectif, vp.duree
FROM VariationPoids vp
LEFT JOIN sakafo s ON vp.idSakafo = s.idSakafo
LEFT JOIN Sport sp ON vp.idSport = sp.idSport;

CREATE OR REPLACE VIEW RegimeParRapportObjectif AS
SELECT
  RO.idRegimeObjectif,
  R.idSakafo,
  R.Nom,
  R.Prix,
  RO.genre
FROM RegimeObjectif AS RO
JOIN sakafo AS R ON RO.idSakafo = R.idSakafo;

CREATE OR REPLACE VIEW SportParRapportObjectif AS
SELECT
  RO.idSportObjectif,
  S.idSport,
  S.Nom,
  RO.genre
FROM SportObjectif AS RO
JOIN Sport AS S ON RO.idSakafo = S.idSport;

CREATE OR REPLACE VIEW PortefeuilleUtilisateur AS
SELECT u.email, p.idPortefeuille, p.montant
FROM users u
JOIN portefeuille p ON u.iduser = p.iduser;

CREATE OR REPLACE VIEW ObjectifAvecNombreRegimes AS
SELECT o.idobjectifs, o.nomObj, COUNT(ro.idRegimeObjectif) AS nombreRegimes
FROM Objectif o
LEFT JOIN RegimeObjectif ro ON o.idobjectifs = ro.idObjectif
GROUP BY o.idobjectifs, o.nomObj;

CREATE OR REPLACE VIEW UtilisateursObjectifAtteint AS
SELECT u.iduser, u.email, u.nom, u.genre
FROM users u
JOIN SuiviRegime sr ON u.iduser = sr.idUser
JOIN RegimeObjectif ro ON sr.idRegime = ro.idRegime
JOIN Objectif o ON ro.idObjectif = o.idobjectifs
WHERE o.nomObj = 'Perte de poids' AND sr.duree >= 30;

CREATE OR REPLACE VIEW SakafoParObjectif AS
SELECT o.nomObj AS objectif, s.Nom AS sakafo
FROM Objectif o
JOIN RegimeObjectif ro ON o.idobjectifs = ro.idObjectif
JOIN sakafo s ON ro.idSakafo = s.idSakafo;

CREATE OR REPLACE VIEW CodesAvecValeur AS
SELECT idCode, code, valeur
FROM code;

UPDATE portefeuille SET montant = (
    SELECT SUM(valeur) FROM code WHERE idPortefeuille = portefeuille.idPortefeuille
) WHERE iduser IN (
    SELECT iduser FROM users
);

ALTER TABLE users ADD COLUMN idPortefeuille INT NULL;
