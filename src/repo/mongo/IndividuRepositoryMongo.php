<?php

require_once 'vendor/autoload.php'; // Charge Composer autoloader

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class IndividuRepository {
    private $client;
    private $collection;

    public function __construct() {
        // Connexion à MongoDB
        $this->client = Utilities::connectMongoDB();
        $this->collection = $this->client->selectDatabase($_ENV['DB_NAME'])->individus; // Collection "individus"
    }

    // Méthode pour insérer un individu
    public function insertIndividu(Individu $individu) {
        $data = [
            'nom' => $individu->getNom(),
            'prenom' => $individu->getPrenom(),
            'statut' => $individu->getStatut(),
            'telephone' => $individu->getTelephone(),
            'adresse' => $individu->getAdresse(),
            'affaires' => $individu->getAffaires() // Tableau d'ObjectId
        ];

        // Insertion dans la base
        $result = $this->collection->insertOne($data);

        return $result->getInsertedId();
    }

    // Méthode pour récupérer un individu par son ID
    public function findIndividuById($id) {
        $result = $this->collection->findOne(['_id' => new ObjectId($id)]);
        if ($result) {
            return new Individu(
                (string)$result['_id'],
                $result['nom'],
                $result['prenom'],
                $result['statut'],
                $result['telephone'],
                $result['adresse'],
                $result['affaires'] ?? []
            );
        }
        return null;
    }

    // Méthode pour récupérer tous les individus
    public function findAllIndividus() {
        $individus = [];
        $cursor = $this->collection->find();

        foreach ($cursor as $document) {
            $individus[] = new Individu(
                (string)$document['_id'],
                $document['nom'],
                $document['prenom'],
                $document['statut'],
                $document['telephone'],
                $document['adresse'],
                $document['affaires'] ?? []
            );
        }

        return $individus;
    }

    // Méthode pour mettre à jour un individu
    public function updateIndividu(Individu $individu) {
        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($individu->getId())],
            ['$set' => [
                'nom' => $individu->getNom(),
                'prenom' => $individu->getPrenom(),
                'statut' => $individu->getStatut(),
                'telephone' => $individu->getTelephone(),
                'adresse' => $individu->getAdresse(),
                'affaires' => $individu->getAffaires()
            ]]
        );

        return $result->getModifiedCount() > 0;
    }

    // Méthode pour supprimer un individu
    public function deleteIndividu($id) {
        $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);
        return $result->getDeletedCount() > 0;
    }
}
?>
