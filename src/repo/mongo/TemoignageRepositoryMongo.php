<?php

require_once 'vendor/autoload.php'; // Charge Composer autoloader

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class TemoignageRepository {
    private $client;
    private $collection;

    public function __construct() {
        // Connexion à MongoDB
        $this->client = Utilities::connectMongoDB();
        $this->collection = $this->client->selectDatabase($_ENV['DB_NAME'])->temoignages; // Collection "temoignages"
    }

    // Méthode pour insérer un témoignage
    public function insertTemoignage(Temoignage $temoignage) {
        $data = [
            'temoin' => $temoignage->getTemoin(), // ObjectId de l'individu
            'description' => $temoignage->getDescription(),
            'date' => $temoignage->getDate(),
            'lieu' => $temoignage->getLieu() // ObjectId du lieu
        ];

        // Insertion dans la base
        $result = $this->collection->insertOne($data);

        return $result->getInsertedId();
    }

    // Méthode pour récupérer un témoignage par son ID
    public function findTemoignageById($id) {
        $result = $this->collection->findOne(['_id' => new ObjectId($id)]);
        if ($result) {
            return new Temoignage(
                (string)$result['_id'],
                $result['temoin'],
                $result['description'],
                $result['date'],
                $result['lieu']
            );
        }
        return null; // Retourne null si le témoignage n'est pas trouvé
    }

    // Méthode pour récupérer tous les témoignages
    public function findAllTemoignages() {
        $temoignages = [];
        $cursor = $this->collection->find();

        foreach ($cursor as $document) {
            $temoignages[] = new Temoignage(
                (string)$document['_id'],
                $document['temoin'],
                $document['description'],
                $document['date'],
                $document['lieu']
            );
        }

        return $temoignages;
    }

    // Méthode pour mettre à jour un témoignage
    public function updateTemoignage(Temoignage $temoignage) {
        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($temoignage->getId())],
            ['$set' => [
                'temoin' => $temoignage->getTemoin(),
                'description' => $temoignage->getDescription(),
                'date' => $temoignage->getDate(),
                'lieu' => $temoignage->getLieu()
            ]]
        );

        return $result->getModifiedCount() > 0; // Retourne true si des modifications ont été effectuées
    }

    // Méthode pour supprimer un témoignage
    public function deleteTemoignage($id) {
        $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);
        return $result->getDeletedCount() > 0; // Retourne true si le témoignage a été supprimé
    }
}
?>
