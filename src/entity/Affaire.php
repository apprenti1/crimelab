<?php

class Affaire {
    private $id;
    private $titre;
    private $image;
    private $description;
    private $date;
    private $lieux; // tableau d'ObjectId
    private $individus; // tableau d'ObjectId
    private $temoignages; // tableau d'ObjectId
    private $fadettes; // tableau d'ObjectId

    public function __construct($id, $titre, $image, $description, $date, $lieux, $individus, $temoignages, $fadettes) {
        $this->id = $id;
        $this->titre = $titre;
        $this->image = $image;
        $this->description = $description;
        $this->date = $date;
        $this->lieux = $lieux;
        $this->individus = $individus;
        $this->temoignages = $temoignages;
        $this->fadettes = $fadettes;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDate() {
        return $this->date;
    }

    public function getLieux() {
        return $this->lieux;
    }

    public function getIndividus() {
        return $this->individus;
    }

    public function getTemoignages() {
        return $this->temoignages;
    }

    public function getFadettes() {
        return $this->fadettes;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setLieux($lieux) {
        $this->lieux = $lieux;
    }

    public function setIndividus($individus) {
        $this->individus = $individus;
    }

    public function setTemoignages($temoignages) {
        $this->temoignages = $temoignages;
    }

    public function setFadettes($fadettes) {
        $this->fadettes = $fadettes;
    }
}
?>
