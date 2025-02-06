<?php
require_once "../src/entity/Produit.php";
class ProduitRepository {
    private $conn;

    public function __construct() {
        $this->conn = Bdd::getBdd();
    }

    public function getAll() {
        $query = 'SELECT * FROM Produit';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        if (isset($result) && !empty($result)) {
            foreach ($result as $entity) {
                $return[] = new Produit($entity['id'], $entity['titre'], $entity['maindoeuvre'], $entity['link']);
            }
        }
        return $return;
    }

    public function getById($id) {
        $query = 'SELECT * FROM Produit WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $entity = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($entity) && !empty($entity)) {
            $return = new Produit($entity['id'], $entity['titre'], $entity['maindoeuvre'], $entity['link']);
        }
        return $return;
    }

    public function create($entity) {
        $query = 'INSERT INTO Produit ( id, titre, maindoeuvre, link ) VALUES ( :id, :titre, :maindoeuvre, :link )';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        $stmt->bindValue(':titre', $entity->getTitre());
        $stmt->bindValue(':maindoeuvre', $entity->getMaindoeuvre());
        $stmt->bindValue(':link', $entity->getLink());
        return $stmt->execute();
    }

    public function update($entity) {
        $query = 'UPDATE Produit SET titre = :titre, maindoeuvre = :maindoeuvre, link = :link WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        $stmt->bindValue(':titre', $entity->getTitre());
        $stmt->bindValue(':maindoeuvre', $entity->getMaindoeuvre());
        $stmt->bindValue(':link', $entity->getLink());
        return $stmt->execute();
    }

    public function delete($entity) {
        $query = 'DELETE FROM Produit WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }

    public function getLast() {
        $query = 'SELECT * FROM produit ORDER BY id DESC LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $entity = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($entity) && !empty($entity)) {
            $return = new Produit($entity['id'], $entity['titre'], $entity['maindoeuvre'], $entity['link']);
        }
        return $return;
    }
}
