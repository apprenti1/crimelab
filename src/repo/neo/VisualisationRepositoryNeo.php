<?php

use Laudis\Neo4j\ClientBuilder;

require_once Utilities::$basepath . 'src/entity/Visualisation.php';

class VisualisationRepository
{
    private $client;

    private $visualisationRepository;

    public function __construct()
    {
        // Connexion à Neo4j
        $this->client = Utilities::connectNeo4j();
    }

    // Méthode pour récupérer toutes les fadettes
    public function findAllFadettes()
    {
        $query = "MATCH (f:Fadette)-[r]->(i:Individu)
RETURN f, r, i";
        $result = $this->client->createSession()->run($query);
        $visu = [];
        foreach ($result as $record) {
        }
        $visu = $result;
        return $visu;
    }
}
