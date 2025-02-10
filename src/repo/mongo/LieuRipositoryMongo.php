<?php

require_once 'vendor/autoload.php'; // Charge Composer autoloader

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class LieuRepository {
    private $client;
    private $collection;

    public function __construct() {
        // Connexion à MongoDB
        $this->client = Utilities::connectMongoDB();
        $this->collection = $this->client->selectDatabase($_ENV['DB_NAME'])->lieux; // Collection "lieux"
    }

    // Méthode pour insérer un lieu
    public function insertLieu(Lieu $lieu) {
        $data = [
            'nom' => $lieu->getNom(),
            'adresse' => $lieu->getAdresse(),
            'coordonnees' => $lieu->getCoordonnees(), // { "lat": ..., "lng": ... }
            'affaires' => $lieu->getAffaires() // Tableau d'ObjectId
        ];

        // Insertion dans la base
        $result = $this->collection->insertOne($data);

        return $result->getInsertedId();
    }

    // Méthode pour récupérer un lieu par son ID
    public function findLieuById($id) {
        $result = $this->collection->findOne(['_id' => new ObjectId($id)]);
        if ($result) {
            return new Lieu(
                (string)$result['_id'],
                $result['nom'],
                $result['adresse'],
                $result['coordonnees'],
                $result['affaires'] ?? []
            );
        }
        return null;
    }

    // Méthode pour récupérer tous les lieux
    public function findAllLieux() {
        $lieux = [];
        $cursor = $this->collection->find();

        foreach ($cursor as $document) {
            $lieux[] = new Lieu(
                (string)$document['_id'],
                $document['nom'],
                $document['adresse'],
                $document['coordonnees'],
                $document['affaires'] ?? []
            );
        }

        return $lieux;
    }

    // Méthode pour mettre à jour un lieu
    public function updateLieu(Lieu $lieu) {
        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($lieu->getId())],
            ['$set' => [
                'nom' => $lieu->getNom(),
                'adresse' => $lieu->getAdresse(),
                'coordonnees' => $lieu->getCoordonnees(),
                'affaires' => $lieu->getAffaires()
            ]]
        );

        return $result->getModifiedCount() > 0;
    }

    // Méthode pour supprimer un lieu
    public function deleteLieu($id) {
        $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);
        return $result->getDeletedCount() > 0;
    }
}
?>
