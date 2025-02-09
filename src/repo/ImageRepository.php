<?php
require_once "../src/entity/Image.php";
class ImageRepository {
    private $conn;

    public function __construct() {
        $this->conn = Bdd::getBdd();
    }

    public function getAll() {
        $query = 'SELECT * FROM Image';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        if (isset($result) && !empty($result)) {
            foreach ($result as $entity) {
                $return[] = new Image($entity['id'], $entity['img'], $entity['emplacement'], $entity['ref_produit']);
            }
        }
        return $return;
    }

    public function getById($id) {
        $query = 'SELECT * FROM Image WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $entity = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result) && !empty($result)) {
            $return = new Image($entity['id'], $entity['img'], $entity['emplacement'], $entity['ref_produit']);
        }
        return $return;
    }

    public function create($entity) {
        $query = 'INSERT INTO Image ( id, img, emplacement, ref_produit ) VALUES ( :id, :img, :emplacement, :ref_produit )';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        $stmt->bindValue(':img', $entity->getImg());
        $stmt->bindValue(':emplacement', $entity->getEmplacement());
        $stmt->bindValue(':ref_produit', $entity->getRef_produit());
        return $stmt->execute();
    }

    public function update($entity) {
        $query = 'UPDATE Image SET img = :img, emplacement = :emplacement, ref_produit = :ref_produit WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        $stmt->bindValue(':img', $entity->getImg());
        $stmt->bindValue(':emplacement', $entity->getEmplacement());
        $stmt->bindValue(':ref_produit', $entity->getRef_produit());
        return $stmt->execute();
    }

    public function delete($entity) {
        $query = 'DELETE FROM Image WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }
}
