<?php

class UserRepository {
    private $conn;

    public function __construct() {
        $this->conn = Bdd::getBdd();
    }

    public function getAll() {
        $query = 'SELECT * FROM User';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        if (isset($result) && !empty($result)) {
            foreach ($result as $entity) {
                $return[] = new User($entity['id'], $entity['email'], $entity['mdp']);
            }
        }
        return $return;
    }

    public function getById($id) {
        $query = 'SELECT * FROM User WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $entity = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (isset($result) && !empty($result)) {
            $return = new User($entity['id'], $entity['email'], $entity['mdp']);
        }
        return $return;
    }

    public function create($entity) {
        $query = 'INSERT INTO User ( id, email, mdp ) VALUES ( :id, :email, :mdp )';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        $stmt->bindValue(':email', $entity->getEmail());
        $stmt->bindValue(':mdp', $entity->getMdp());
        return $stmt->execute();
    }

    public function update($entity) {
        $query = 'UPDATE User SET email = :email, mdp = :mdp WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        $stmt->bindValue(':email', $entity->getEmail());
        $stmt->bindValue(':mdp', $entity->getMdp());
        return $stmt->execute();
    }

    public function delete($entity) {
        $query = 'DELETE FROM User WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $entity->getId());
        return $stmt->execute();
    }

    public function connect($email, $mdp) {
        $query = 'SELECT mdp FROM User WHERE email = :email';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return isset($result['mdp']) && !empty($result['mdp'] && password_verify($mdp, $result['mdp']));
    }
}
