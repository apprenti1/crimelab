<?php

class Fadette {
    private $id;
    private $individu; // ObjectId
    private $appelants; // tableau d'objets avec "numero", "date", "antenne"
    private $date; // date de la fadette

    public function __construct($id, $individu, $appelants, $date) {
        $this->id = $id;
        $this->individu = $individu;
        $this->appelants = $appelants;
        $this->date = $date;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIndividu() {
        return $this->individu;
    }

    public function getAppelants() {
        return $this->appelants;
    }

    public function getDate() {
        return $this->date;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIndividu($individu) {
        $this->individu = $individu;
    }

    public function setAppelants($appelants) {
        $this->appelants = $appelants;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}
?>

