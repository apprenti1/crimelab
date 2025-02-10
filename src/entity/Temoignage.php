<?php

class Temoignage {
    private $id;
    private $temoin; // ObjectId
    private $description;
    private $date;
    private $lieu; // ObjectId

    public function __construct($id, $temoin, $description, $date, $lieu) {
        $this->id = $id;
        $this->temoin = $temoin;
        $this->description = $description;
        $this->date = $date;
        $this->lieu = $lieu;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTemoin() {
        return $this->temoin;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDate() {
        return $this->date;
    }

    public function getLieu() {
        return $this->lieu;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTemoin($temoin) {
        $this->temoin = $temoin;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setLieu($lieu) {
        $this->lieu = $lieu;
    }
}
?>
