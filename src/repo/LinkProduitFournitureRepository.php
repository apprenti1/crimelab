<?php

class LinkProduitFournitureRepository {
    private $conn;

    public function __construct() {
        $this->conn = Bdd::getBdd();
    }

    public function getAll() {
        $query = 'SELECT * FROM LinkProduitFourniture';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        if (isset($result) && !empty($result)) {
            foreach ($result as $entity) {
                $return[] = new LinkProduitFourniture($entity['ref_produit'], $entity['ref_fourniture']);
            }
        }
        return $return;
    }

    public function getById($id) {
        $query = 'SELECT * FROM LinkProduitFourniture WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $entity = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result) && !empty($result)) {
            $return = new LinkProduitFourniture($entity['ref_produit'], $entity['ref_fourniture']);
        }
        return $return;
    }

    public function create($entity) {
        $query = 'INSERT INTO LinkProduitFourniture ( ref_produit, ref_fourniture ) VALUES ( :ref_produit, :ref_fourniture )';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':ref_produit', $entity->getRef_produit());
        $stmt->bindValue(':ref_fourniture', $entity->getRef_fourniture());
        return $stmt->execute();
    }

    public function update($entity) {
        $query = 'UPDATE LinkProduitFourniture SET ref_produit = :ref_produit, ref_fourniture = :ref_fourniture WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':ref_produit', $entity->getRef_produit());
        $stmt->bindValue(':ref_fourniture', $entity->getRef_fourniture());
        return $stmt->execute();
    }

    public function delete($entity) {
        $query = 'DELETE FROM LinkProduitFourniture WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }
}
