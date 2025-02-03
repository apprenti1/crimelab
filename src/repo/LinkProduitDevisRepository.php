<?php

class LinkProduitDevisRepository {
    private $conn;

    public function __construct() {
        $this->conn = Bdd::getBdd();
    }

    public function getAll() {
        $query = 'SELECT * FROM LinkProduitDevis';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        if (isset($result) && !empty($result)) {
            foreach ($result as $entity) {
                $return[] = new LinkProduitDevis($entity['ref_produit'], $entity['ref_devis']);
            }
        }
        return $return;
    }

    public function getById($id) {
        $query = 'SELECT * FROM LinkProduitDevis WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $entity = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result) && !empty($result)) {
            $return = new LinkProduitDevis($entity['ref_produit'], $entity['ref_devis']);
        }
        return $return;
    }

    public function create($entity) {
        $query = 'INSERT INTO LinkProduitDevis ( ref_produit, ref_devis ) VALUES ( :ref_produit, :ref_devis )';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':ref_produit', $entity->getRef_produit());
        $stmt->bindValue(':ref_devis', $entity->getRef_devis());
        return $stmt->execute();
    }

    public function update($entity) {
        $query = 'UPDATE LinkProduitDevis SET ref_produit = :ref_produit, ref_devis = :ref_devis WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':ref_produit', $entity->getRef_produit());
        $stmt->bindValue(':ref_devis', $entity->getRef_devis());
        return $stmt->execute();
    }

    public function delete($entity) {
        $query = 'DELETE FROM LinkProduitDevis WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }
}
