<?php

class Lieu {
    private $id;
    private $nom;
    private $adresse;
    private $coordonnees; // tableau avec 'lat' et 'lng'
    private $affaires; // tableau d'ObjectId

    public function __construct($id, $nom, $adresse, $coordonnees, $affaires) {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->coordonnees = $coordonnees;
        $this->affaires = $affaires;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getCoordonnees() {
        return $this->coordonnees;
    }

    public function getAffaires() {
        return $this->affaires;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setCoordonnees($coordonnees) {
        $this->coordonnees = $coordonnees;
    }

    public function setAffaires($affaires) {
        $this->affaires = $affaires;
    }
}
?>
