<?php

require_once 'vendor/autoload.php'; // Charge Composer autoloader

use MongoDB\Client;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class FadetteRepository {
    private $client;
    private $collection;

    public function __construct() {
        // Connexion à MongoDB
        $this->client = Utilities::connectMongoDB();
        $this->collection = $this->client->selectDatabase($_ENV['DB_NAME'])->affaires;
    }

    // Méthode pour insérer une fadette
    public function insertFadette(Fadette $fadette) {
        $data = [
            'individu_id' => $fadette->getIndividuId(),
            'appelants' => $fadette->getAppelants(), // Tableau des appelants
            'date' => new UTCDateTime() // Date de la fadette
        ];

        // Insertion dans la base
        $result = $this->collection->insertOne($data);

        return $result->getInsertedId();
    }

    // Méthode pour récupérer une fadette par son ID
    public function findFadetteById($id) {
        $result = $this->collection->findOne(['_id' => new ObjectId($id)]);
        if ($result) {
            return new Fadette(
                (string)$result['_id'],
                $result['individu_id'],
                $result['appelants'],
                $result['date']->toDateTime()->format('Y-m-d H:i:s')
            );
        }
        return null; // Retourne null si la fadette n'est pas trouvée
    }

    // Méthode pour récupérer toutes les fadettes
    public function findAllFadettes() {
        $fadettes = [];
        $cursor = $this->collection->find();

        foreach ($cursor as $document) {
            $fadettes[] = new Fadette(
                (string)$document['_id'],
                $document['individu_id'],
                $document['appelants'],
                $document['date']->toDateTime()->format('Y-m-d H:i:s')
            );
        }

        return $fadettes;
    }

    // Méthode pour mettre à jour une fadette
    public function updateFadette(Fadette $fadette) {
        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($fadette->getId())],
            ['$set' => [
                'individu_id' => $fadette->getIndividuId(),
                'appelants' => $fadette->getAppelants(),
                'date' => new UTCDateTime($fadette->getDate()->format('Y-m-d H:i:s'))
            ]]
        );

        return $result->getModifiedCount() > 0;
    }

    // Méthode pour supprimer une fadette
    public function deleteFadette($id) {
        $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);
        return $result->getDeletedCount() > 0;
    }
}
?>

