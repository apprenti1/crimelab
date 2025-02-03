<?php
require_once "../src/entity/Fourniture.php";
class FournitureRepository {
    private $conn;

    public function __construct() {
        $this->conn = Bdd::getBdd();
    }

    public function getAll() {
        $query = 'SELECT * FROM Fourniture';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        if (isset($result) && !empty($result)) {
            foreach ($result as $entity) {
                $return[] = new Fourniture($entity['id'], $entity['titre'], $entity['prix']);
            }
        }
        return $return;
    }

    public function getById($id) {
        $query = 'SELECT * FROM Fourniture WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $entity = $stmt->fetch(PDO::FETCH_ASSOC);
        $return = null;
        if (isset($entity) && !empty($entity)) {
            $return = (new Fourniture($entity['id'], $entity['titre'], $entity['prix']));
        }
        return $return;
    }

    public function create($entity) {
        $query = 'INSERT INTO Fourniture ( titre, prix ) VALUES ( :titre, :prix )';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':titre', $entity->getTitre());
        $stmt->bindValue(':prix', $entity->getPrix());
        return $stmt->execute();
    }

    public function update($entity) {
        $query = 'UPDATE Fourniture SET titre = :titre, prix = :prix WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        $stmt->bindValue(':titre', $entity->getTitre());
        $stmt->bindValue(':prix', $entity->getPrix());
        return $stmt->execute();
    }

    public function delete($entity) {
        $query = 'DELETE FROM Fourniture WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }
}
