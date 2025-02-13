<?php

require_once 'vendor/autoload.php'; // Charge Composer autoloader

use Laudis\Neo4j\ClientBuilder;

class AffaireRepository {
    private $client;

    public function __construct() {
        // Connexion à Neo4j
        $this->client = Utilities::connectNeo4j();
    }

    // Méthode pour insérer une affaire
    public function insertAffaire(Affaire $affaire) {
        $query = "CREATE (a: Affaire { titre: \$titre, image: \$image, description: \$description, date: \$date, lieux: \$lieux, individus: \$individus, temoignages: \$temoignages, fadettes: \$fadettes }) RETURN a";
        $result = $this->client->run($query, [
            'titre' => $affaire->getTitre(),
            'image' => $affaire->getImage(),
            'description' => $affaire->getDescription(),
            'date' => $affaire->getDate(),
            'lieux' => $affaire->getLieux(),
            'individus' => $affaire->getIndividus(),
            'temoignages' => $affaire->getTemoignages(),
            'fadettes' => $affaire->getFadettes()
        ]);

        return $result->singleNode()->identity();
    }

    // Méthode pour récupérer une affaire par son ID
    public function findAffaireById($id) {
        $query = "MATCH (a: Affaire) WHERE id(a) = \$id RETURN a";
        $result = $this->client->run($query, ['id' => (int)$id]);

        if ($result->count() > 0) {
            $record = $result->singleRecord()->get('a');
            return new Affaire(
                (string)$record->identity(),
                $record->get('titre'),
                $record->get('image'),
                $record->get('description'),
                $record->get('date'),
                $record->get('lieux'),
                $record->get('individus'),
                $record->get('temoignages'),
                $record->get('fadettes')
            );
        }
        return null; // Retourne null si l'affaire n'est pas trouvée
    }

    // Méthode pour récupérer toutes les affaires
    public function findAllAffaires() {
        $affaires = [];
        $result = $this->client->run("MATCH (a: Affaire) RETURN a");

        foreach ($result->getRecords() as $record) {
            $affaires[] = new Affaire(
                (string)$record->get('a')->identity(),
                $record->get('a')->get('titre'),
                $record->get('a')->get('image'),
                $record->get('a')->get('description'),
                $record->get('a')->get('date'),
                $record->get('a')->get('lieux'),
                $record->get('a')->get('individus'),
                $record->get('a')->get('temoignages'),
                $record->get('a')->get('fadettes')
            );
        }

        return $affaires;
    }

    // Méthode pour mettre à jour une affaire
    public function updateAffaire(Affaire $affaire) {
        $query = "MATCH (a: Affaire) WHERE id(a) = \$id SET a = \$affaire RETURN a";
        $result = $this->client->run($query, [
            'id' => (int)$affaire->getId(),
            'affaire' => [
                'titre' => $affaire->getTitre(),
                'image' => $affaire->getImage(),
                'description' => $affaire->getDescription(),
                'date' => $affaire->getDate(),
                'lieux' => $affaire->getLieux(),
                'individus' => $affaire->getIndividus(),
                'temoignages' => $affaire->getTemoignages(),
                'fadettes' => $affaire->getFadettes()
            ]
        ]);

        return $result->getStatistics()->getNodesCreated() > 0;
    }

    // Méthode pour supprimer une affaire
    public function deleteAffaire($id) {
        $query = "MATCH (a: Affaire) WHERE id(a) = \$id DELETE a";
        $result = $this->client->run($query, ['id' => (int)$id]);

        return $result->getStatistics()->getNodesDeleted() > 0;
    }
}

