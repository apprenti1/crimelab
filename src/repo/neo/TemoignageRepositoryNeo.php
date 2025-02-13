<?php

require_once 'vendor/autoload.php'; // Charge Composer autoloader

use Laudis\Neo4j\ClientBuilder;
use Laudis\Neo4j\Types\CypherList;
use Laudis\Neo4j\Types\CypherMap;

class TemoignageRepository {
    private $client;

    public function __construct() {
        // Connexion à Neo4j
        $this->client = Utilities::connectNeo4j();
    }

    // Méthode pour insérer un témoignage
    public function insertTemoignage(Temoignage $temoignage) {
        $query = "CREATE (t: Temoignage { id: \$id, temoin: \$temoin, description: \$description, date: \$date, lieu: \$lieu }) RETURN t";
        $result = $this->client->run($query, [
            'id' => $temoignage->getId(),
            'temoin' => $temoignage->getTemoin(),
            'description' => $temoignage->getDescription(),
            'date' => $temoignage->getDate(),
            'lieu' => $temoignage->getLieu()
        ]);

        return $result->singleNode()->identity();
    }

    // Méthode pour récupérer un témoignage par son ID
    public function findTemoignageById($id) {
        $query = "MATCH (t: Temoignage) WHERE id(t) = \$id RETURN t";
        $result = $this->client->run($query, ['id' => (int)$id]);

        if ($result->count() > 0) {
            $record = $result->singleRecord()->get('t');
            return new Temoignage(
                (string)$record->identity(),
                $record->get('temoin'),
                $record->get('description'),
                $record->get('date'),
                $record->get('lieu')
            );
        }
        return null; // Retourne null si le témoignage n'est pas trouvé
    }

    // Méthode pour récupérer tous les témoignages
    public function findAllTemoignages() {
        $query = "MATCH (t: Temoignage) RETURN t";
        $result = $this->client->run($query);

        $temoignages = [];
        foreach ($result->getRecords() as $record) {
            $temoignages[] = new Temoignage(
                (string)$record->get('t')->identity(),
                $record->get('t')->get('temoin'),
                $record->get('t')->get('description'),
                $record->get('t')->get('date'),
                $record->get('t')->get('lieu')
            );
        }

        return $temoignages;
    }

    // Méthode pour mettre à jour un témoignage
    public function updateTemoignage(Temoignage $temoignage) {
        $query = "MATCH (t: Temoignage) WHERE id(t) = \$id SET t.temoin = \$temoin, t.description = \$description, t.date = \$date, t.lieu = \$lieu RETURN t";
        $result = $this->client->run($query, [
            'id' => (int)$temoignage->getId(),
            'temoin' => $temoignage->getTemoin(),
            'description' => $temoignage->getDescription(),
            'date' => $temoignage->getDate(),
            'lieu' => $temoignage->getLieu()
        ]);

        return $result->count() > 0; // Retourne true si des modifications ont été effectuées
    }

    // Méthode pour supprimer un témoignage
    public function deleteTemoignage($id) {
        $query = "MATCH (t: Temoignage) WHERE id(t) = \$id DELETE t";
        $result = $this->client->run($query, ['id' => (int)$id]);

        return $result->count() > 0; // Retourne true si le témoignage a été supprimé
    }
}

