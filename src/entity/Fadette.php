<?php

class Fadette {
    private $id;
    private $individu; // ObjectId
    private $appelants; // tableau d'objets avec "numero", "date", "antenne"

    public function __construct($id, $individu, $appelants) {
        $this->id = $id;
        $this->individu = $individu;
        $this->appelants = $appelants;
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
}
?>
