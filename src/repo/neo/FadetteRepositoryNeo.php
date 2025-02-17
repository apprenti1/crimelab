<?php

//require_once 'vendor/autoload.php'; // Charge Composer autoloader

use Laudis\Neo4j\ClientBuilder;
require_once Utilities::$basepath.'src/entity/Individu.php';
require_once Utilities::$basepath.'src/repo/neo/IndividuRepositoryNeo.php';

class FadetteRepository {
    private $client;
    
    private $individuRepository;

    public function __construct() {
        // Connexion à Neo4j
        $this->client = Utilities::connectNeo4j();
        $this->individuRepository = new IndividuRepository();
    }

    // Méthode pour insérer une fadette
    public function insertFadette(Fadette $fadette) {
        $query = "CREATE (f:Fadette {
            individu_id: \$individu_id,
            appelants: \$appelants,
            date: \$date
        }) RETURN id(f)";

        $parameters = [
            'individu_id' => $fadette->getIndividu()->getId(),
            'appelants' => $fadette->getAppelants(),
            'date' => $fadette->getDate()
            // 'date' => $fadette->getDate()->format('Y-m-d H:i:s')
        ];

        $result = $this->client->createSession()->run($query, $parameters);
        return $result[0]->get('id(f)');
    }

    // Méthode pour récupérer une fadette par son ID
    public function findFadetteById($id) {
        $query = "MATCH (f:Fadette) WHERE id(f) = \$id RETURN f";
        $result = $this->client->createSession()->run($query, ['id' => (int)$id]);

        if ($result->count() > 0) {
            $record = $result[0]['f'];
            return new Fadette(
                (string)$record->id(),
                $this->individuRepository->findIndividuById($record->get('individu_id')),
                $record->get('appelants'),
                $record->get('date')
                // new DateTime($record->get('date'))
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
            echo "<pre>";
            var_dump($record->get('f'));
            echo "</pre>";
            $node = $record->get('f');
            $fadettes[] = new Fadette(
                (string)$node['id'],
                $this->individuRepository->findIndividuById($node['properties']['individu_id']),
                $node['properties']['appelants'],
                $node['properties']['date']
                // new DateTime($node->get('date'))
            );
        }
        return $fadettes;
    }

    // Méthode pour mettre à jour une fadette
    public function updateFadette(Fadette $fadette) {
        $query = "MATCH (f:Fadette) WHERE id(f) = \$id SET f.individu_id = \$individu_id, f.appelants = \$appelants, f.date = \$date RETURN f";
        $parameters = [
            'id' => (int)$fadette->getId(),
            'individu_id' => $fadette->getIndividu()->getId(),
            'appelants' => $fadette->getAppelants(),
            'date' => $fadette->getDate()
            // 'date' => $fadette->getDate()->format('Y-m-d H:i:s')
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

