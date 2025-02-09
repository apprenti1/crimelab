<?php

class Image {
    private $id;
    private $img;
    private $emplacement;
    private $ref_produit;

    public function __construct($id, $img, $emplacement, $ref_produit) {
        $this->setId($id);
        $this->setImg($img);
        $this->setEmplacement($emplacement);
        $this->setRef_produit($ref_produit);
    }

    public function getId() {return $this->id;}
    public function getImg() {return $this->img;}
    public function getEmplacement() {return $this->emplacement;}
    public function getRef_produit() {return $this->ref_produit;}
    public function setId($value) {$this->id = $value;}
    public function setImg($value) {$this->img = $value;}
    public function setEmplacement($value) {$this->emplacement = $value;}
    public function setRef_produit($value) {$this->ref_produit = $value;}
}
