/*
----------Ru3Conc7p----------
    ? User
        .id
        *email
        *mdp
    .
    ? Produit
        .id
        *titre
        *maindoeuvre
        *link
    .
    ? Image
        .id
        *img
        *text
        *emplacement
        *ref_produit
    .
    ? Fourniture
        .id
        *titre
        *prix
    .
    ? LinkProduitFourniture
        *ref_produit
        *ref_fourniture
    .
    ? Devis
        .id
    .
    ? LinkProduitDevis
        *ref_produit
        *ref_devis
----------Ru3Conc7p---------->
*/--

-- * BDD setup
    -- . Création de la base de données
        CREATE DATABASE IF NOT EXISTS Ru3Conc7p;
    
    -- . Utilisation de la base de données Ru3Conc7p
        USE Ru3Conc7p;

    -- . Définir le moteur de stockage InnoDB par défaut
        SET default_storage_engine = InnoDB;

    -- .
-- * Ajout des tables
    -- . Table User
        CREATE TABLE `User` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(255) NOT NULL UNIQUE,
            mdp VARCHAR(1000) NOT NULL
        ) ENGINE=InnoDB;

    -- . Table Produit
        CREATE TABLE `Produit` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            titre VARCHAR(255) NOT NULL,
            maindoeuvre INT(2) NOT NULL,
            link VARCHAR(512) NOT NULL
        ) ENGINE=InnoDB;

    -- . Table Image
        CREATE TABLE `Image` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            img LONGTEXT NOT NULL,
            text VARCHAR(64),
            emplacement INT(1) DEFAULT 0 NOT NULL,
            ref_produit INT
        ) ENGINE=InnoDB;

    -- . Table Fourniture
        CREATE TABLE `Fourniture` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            titre VARCHAR(64) NOT NULL,
            prix INT(3) DEFAULT 0 NOT NULL
        ) ENGINE=InnoDB;

    -- . Table LinkProduitFourniture
        CREATE TABLE `LinkProduitFourniture` (
            ref_produit INT,
            ref_fourniture INT
        ) ENGINE=InnoDB;

    -- . Table Devis
        CREATE TABLE `Devis` (
            id INT PRIMARY KEY AUTO_INCREMENT
        ) ENGINE=InnoDB;

    -- . Table LinkProduitDevis
        CREATE TABLE `LinkProduitDevis` (
            ref_produit INT,
            ref_devis INT
        ) ENGINE=InnoDB;

    -- .
-- *Ajout des contraintes de clé étrangère
    -- . Table Image
        ALTER TABLE `Image` ADD FOREIGN KEY (ref_produit) 
        REFERENCES Produit(id);

    -- . Table LinkProduitFourniture
        ALTER TABLE `LinkProduitFourniture` ADD FOREIGN KEY (ref_produit) 
        REFERENCES Produit(id);
        ALTER TABLE `LinkProduitFourniture` ADD FOREIGN KEY (ref_fourniture) 
        REFERENCES Fourniture(id);

    -- . Table LinkProduitDevis
        ALTER TABLE `LinkProduitDevis` ADD FOREIGN KEY (ref_produit) 
        REFERENCES Produit(id);
        ALTER TABLE `LinkProduitDevis` ADD FOREIGN KEY (ref_devis) 
        REFERENCES Devis(id);
    
    -- .
