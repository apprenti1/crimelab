<?php

class DevisRepository {
    private $conn;

    public function __construct() {
        $this->conn = Bdd::getBdd();
    }

    public function getAll() {
        $query = 'SELECT * FROM Devis';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        if (isset($result) && !empty($result)) {
            foreach ($result as $entity) {
                $return[] = new Devis($entity['id']);
            }
        }
        return $return;
    }

    public function getById($id) {
        $query = 'SELECT * FROM Devis WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $entity = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result) && !empty($result)) {
            $return = new Devis($entity['id']);
        }
        return $return;
    }

    public function create($entity) {
        $query = 'INSERT INTO Devis ( id ) VALUES ( :id )';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }

    public function update($entity) {
        $query = 'UPDATE Devis SET  WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }

    public function delete($entity) {
        $query = 'DELETE FROM Devis WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }
}
