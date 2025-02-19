<?php

class Individu {
    public $id;
    public $nom;
    public $prenom;
    public $statut;
    public $telephone;
    public $adresse;
    public $affaires; // tableau d'ObjectId

    public function __construct($id, $nom, $prenom, $statut, $telephone, $adresse, $affaires) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->statut = $statut;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
        $this->affaires = $affaires;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getAdresse() {
        return $this->adresse;
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

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setAffaires($affaires) {
        $this->affaires = $affaires;
    }
}
?>
