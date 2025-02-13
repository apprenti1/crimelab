<?php

require_once 'vendor/autoload.php'; // Charge Composer autoloader

use Laudis\Neo4j\ClientBuilder;
use Laudis\Neo4j\Databags\ResultSummary;
use Laudis\Neo4j\Databags\Statement;
use Laudis\Neo4j\Types\CypherList;
use Laudis\Neo4j\Types\CypherMap;

class LieuRepository {
    private $client;

    public function __construct() {
        // Connexion à Neo4j
        $this->client = Utilities::connectNeo4j();
    }

    // Méthode pour insérer un lieu
    public function insertLieu(Lieu $lieu): ResultSummary {
        $query = "CREATE (l:Lieu {nom: \$nom, adresse: \$adresse, coordonnees: \$coordonnees, affaires: \$affaires}) RETURN l";
        $parameters = [
            'nom' => $lieu->getNom(),
            'adresse' => $lieu->getAdresse(),
            'coordonnees' => $lieu->getCoordonnees(),
            'affaires' => new CypherList($lieu->getAffaires())
        ];

        return $this->client->run($query, $parameters);
    }

    // Méthode pour récupérer un lieu par son ID
    public function findLieuById($id): ?Lieu {
        $query = "MATCH (l:Lieu {id: \$id}) RETURN l";
        $result = $this->client->run($query, ['id' => (int)$id]);

        if ($result->count() > 0) {
            $record = $result->firstRecord();
            return new Lieu(
                (string)$record->get('l')->id(),
                $record->get('l')->get('nom'),
                $record->get('l')->get('adresse'),
                $record->get('l')->get('coordonnees'),
                $record->get('l')->get('affaires') ?? []
            );
        }
        return null;
    }

    // Méthode pour récupérer tous les lieux
    public function findAllLieux(): array {
        $lieux = [];
        $query = "MATCH (l:Lieu) RETURN l";
        $result = $this->client->run($query);

        foreach ($result->getRecords() as $record) {
            $lieux[] = new Lieu(
                (string)$record->get('l')->id(),
                $record->get('l')->get('nom'),
                $record->get('l')->get('adresse'),
                $record->get('l')->get('coordonnees'),
                $record->get('l')->get('affaires') ?? []
            );
        }

        return $lieux;
    }

    // Méthode pour mettre à jour un lieu
    public function updateLieu(Lieu $lieu): ResultSummary {
        $query = "MATCH (l:Lieu {id: \$id}) SET l.nom = \$nom, l.adresse = \$adresse, l.coordonnees = \$coordonnees, l.affaires = \$affaires RETURN l";
        $parameters = [
            'id' => (int)$lieu->getId(),
            'nom' => $lieu->getNom(),
            'adresse' => $lieu->getAdresse(),
            'coordonnees' => $lieu->getCoordonnees(),
            'affaires' => new CypherList($lieu->getAffaires())
        ];

        return $this->client->run($query, $parameters);
    }

    // Méthode pour supprimer un lieu
    public function deleteLieu($id): ResultSummary {
        $query = "MATCH (l:Lieu {id: \$id}) DELETE l";
        return $this->client->run($query, ['id' => (int)$id]);
    }
}

