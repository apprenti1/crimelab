<?php

//require_once 'vendor/autoload.php'; // Charge Composer autoloader

use Laudis\Neo4j\ClientBuilder;

class FadetteRepository {
    private $client;

    public function __construct() {
        // Connexion à Neo4j
        $this->client = Utilities::connectNeo4j();
    }

    // Méthode pour insérer une fadette
    public function insertFadette(Fadette $fadette) {
        $query = "CREATE (f:Fadette {
            individu_id: \$individu_id,
            appelants: \$appelants,
            date: \$date
        }) RETURN id(f)";

        $parameters = [
            'individu_id' => $fadette->getIndividuId(),
            'appelants' => $fadette->getAppelants(),
            'date' => $fadette->getDate()->format('Y-m-d H:i:s')
        ];

        $result = $this->client->createSession()->run($query, $parameters);
        return $result->firstRecord()->get('id(f)');
    }

    // Méthode pour récupérer une fadette par son ID
    public function findFadetteById($id) {
        $query = "MATCH (f:Fadette) WHERE id(f) = \$id RETURN f";
        $result = $this->client->createSession()->run($query, ['id' => (int)$id]);

        if ($result->count() > 0) {
            $record = $result->firstRecord()->get('f');
            return new Fadette(
                (string)$record->id(),
                $record->get('individu_id'),
                $record->get('appelants'),
                new DateTime($record->get('date'))
            );
        }
        return null; // Retourne null si la fadette n'est pas trouvée
    }

    // Méthode pour récupérer toutes les fadettes
    public function findAllFadettes() {
        $query = "MATCH (f:Fadette) RETURN f";
        $result = $this->client->createSession()->run($query);
        $fadettes = [];
        foreach ($result as $record) {
            $node = $record->get('f');
            $fadettes[] = new Fadette(
                (string)$node->id(),
                $node->get('individu_id'),
                $node->get('appelants'),
                new DateTime($node->get('date'))
            );
        }
        return $fadettes;
    }

    // Méthode pour mettre à jour une fadette
    public function updateFadette(Fadette $fadette) {
        $query = "MATCH (f:Fadette) WHERE id(f) = \$id SET f.individu_id = \$individu_id, f.appelants = \$appelants, f.date = \$date RETURN f";
        $parameters = [
            'id' => (int)$fadette->getId(),
            'individu_id' => $fadette->getIndividuId(),
            'appelants' => $fadette->getAppelants(),
            'date' => $fadette->getDate()->format('Y-m-d H:i:s')
        ];

        $result = $this->client->createSession()->run($query, $parameters);
        return $result->count() > 0;
    }

    // Méthode pour supprimer une fadette
    public function deleteFadette($id) {
        $query = "MATCH (f:Fadette) WHERE id(f) = \$id DELETE f";
        $result = $this->client->createSession()->run($query, ['id' => (int)$id]);
        return $result->count() > 0;
    }
}

