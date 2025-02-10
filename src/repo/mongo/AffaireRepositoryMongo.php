<?php

//require_once 'vendor/autoload.php'; // Charge Composer autoloader

use MongoDB\BSON\ObjectId;

class AffaireRepository {
    private $client;
    private $collection;

    public function __construct() {
        // Connexion à MongoDB
        $this->client = Utilities::connectMongoDB();
        $this->collection = $this->client->selectDatabase($_ENV['DB_NAME'])->affaires;
    }

    // Méthode pour insérer une affaire
    public function insertAffaire(Affaire $affaire) {
        $data = [
            'titre' => $affaire->getTitre(),
            'image' => $affaire->getImage(),
            'description' => $affaire->getDescription(),
            'date' => $affaire->getDate(),
            'lieux' => $affaire->getLieux(),
            'individus' => $affaire->getIndividus(),
            'temoignages' => $affaire->getTemoignages(),
            'fadettes' => $affaire->getFadettes()
        ];

        // Insertion dans la base
        $result = $this->collection->insertOne($data);

        return $result->getInsertedId();
    }

    // Méthode pour récupérer une affaire par son ID
    public function findAffaireById($id) {
        $result = $this->collection->findOne(['_id' => new ObjectId($id)]);
        if ($result) {
            return new Affaire(
                (string)$result['_id'],
                $result['titre'],
                $result['image'],
                $result['description'],
                $result['date'],
                $result['lieux'],
                $result['individus'],
                $result['temoignages'],
                $result['fadettes']
            );
        }
        return null; // Retourne null si l'affaire n'est pas trouvée
    }

    // Méthode pour récupérer toutes les affaires
    public function findAllAffaires() {
        $affaires = [];
        $cursor = $this->collection->find();

        foreach ($cursor as $document) {
            $affaires[] = new Affaire(
                (string)$document['_id'],
                $document['titre'],
                $document['image'],
                $document['description'],
                $document['date'],
                $document['lieux'],
                $document['individus'],
                $document['temoignages'],
                $document['fadettes']
            );
        }

        return $affaires;
    }

    // Méthode pour mettre à jour une affaire
    public function updateAffaire(Affaire $affaire) {
        $result = $this->collection->updateOne(
            ['_id' => new ObjectId($affaire->getId())],
            ['$set' => [
                'titre' => $affaire->getTitre(),
                'image' => $affaire->getImage(),
                'description' => $affaire->getDescription(),
                'date' => $affaire->getDate(),
                'lieux' => $affaire->getLieux(),
                'individus' => $affaire->getIndividus(),
                'temoignages' => $affaire->getTemoignages(),
                'fadettes' => $affaire->getFadettes()
            ]]
        );

        return $result->getModifiedCount() > 0;
    }

    // Méthode pour supprimer une affaire
    public function deleteAffaire($id) {
        $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);
        return $result->getDeletedCount() > 0;
    }
}
?>
