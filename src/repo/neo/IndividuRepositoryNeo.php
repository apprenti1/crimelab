<?php

//require_once 'vendor/autoload.php'; // Charge Composer autoloader

use Laudis\Neo4j\ClientBuilder;

class IndividuRepository {
    private $client;

    public function __construct() {
        // Connexion à Neo4j
        $this->client = Utilities::connectNeo4j();
    }

    // Méthode pour insérer un individu
    public function insertIndividu(Individu $individu) {
        $query = "CREATE (i:Individu {
            nom: \$nom,
            prenom: \$prenom,
            statut: \$statut,
            telephone: \$telephone,
            adresse: \$adresse,
            affaires: \$affaires
        }) RETURN id(i)";

        $parameters = [
            'nom' => $individu->getNom(),
            'prenom' => $individu->getPrenom(),
            'statut' => $individu->getStatut(),
            'telephone' => $individu->getTelephone(),
            'adresse' => $individu->getAdresse(),
            'affaires' => $individu->getAffaires()
        ];

        $result = $this->client->createSession()->run($query, $parameters);
        return $result[0]->get('id(i)');
    }

    // Méthode pour récupérer un individu par son ID
    public function findIndividuById($id) {
        $query = "MATCH (i:Individu) WHERE id(i) = \$id RETURN i";
        $result = $this->client->createSession()->run($query, ['id' => (int)$id]);
        if ($result->count() > 0) {
            $result = $result[0]['i'];
            return new Individu(
                (int)$result['id'],
                $result['properties']['nom'],
                $result['properties']['prenom'],
                $result['properties']['statut'],
                $result['properties']['telephone'],
                $result['properties']['adresse'],
                $result['properties']['affaires'] ?? []
            );
        }
        return null;
    }

    // Méthode pour récupérer tous les individus
    public function findAllIndividus() {
        $query = "MATCH (i:Individu) RETURN i";
        $result = $this->client->createSession()->run($query);

        $individus = [];
        foreach ($result as $record) {
            $node = $record->get('i');
            $individus[] = new Individu(
                (int)$node['id'],
                $node['properties']['nom'],
                $node['properties']['prenom'],
                $node['properties']['statut'],
                $node['properties']['telephone'],
                $node['properties']['adresse'],
                $node['properties']['affaires'] ?? []
            );
        }
        return $individus;
    }

    // Méthode pour mettre à jour un individu
    public function updateIndividu(Individu $individu) {
        $query = "MATCH (i:Individu) WHERE id(i) = \$id SET i = {
            nom: \$nom,
            prenom: \$prenom,
            statut: \$statut,
            telephone: \$telephone,
            adresse: \$adresse,
            affaires: \$affaires
        } RETURN i";

        $parameters = [
            'id' => (int)$individu->getId(),
            'nom' => $individu->getNom(),
            'prenom' => $individu->getPrenom(),
            'statut' => $individu->getStatut(),
            'telephone' => $individu->getTelephone(),
            'adresse' => $individu->getAdresse(),
            'affaires' => $individu->getAffaires()
        ];

        $result = $this->client->createSession()->run($query, $parameters);
        return $result->count() > 0;
    }

    // Méthode pour supprimer un individu
    public function deleteIndividu($id) {
        $query = "MATCH (i:Individu) WHERE id(i) = \$id DELETE i";
        $result = $this->client->createSession()->run($query, ['id' => (int)$id]);
        return $result->count() > 0;
    }

public function findIndividuByTel($telephone) {
    $query = "MATCH (i:Individu) WHERE i.telephone = \$telephone RETURN i";
    $result = $this->client->createSession()->run($query, ['telephone' => $telephone]);
    if ($result->count() > 0) {
        $node = $result[0]->get('i');
        return new Individu(
            (int)$node['id'],
            $node['properties']['nom'],
            $node['properties']['prenom'],
            $node['properties']['statut'],
            $node['properties']['telephone'],
            $node['properties']['adresse'],
            $node['properties']['affaires'] ?? []
        );
    }
    return null;
}


    // Méthode pour créer une relation entre un individu et une fadette
    public function createRelation(Individu $individu, Fadette $fadette) {
        $query = "MATCH (i:Individu), (f:Fadette) WHERE id(i) = ".$individu->getId()." AND id(f) = ".$fadette->getId()." CREATE (i)-[:FADETTE]->(f)";

        $result = $this->client->createSession()->run($query, []);
        return $result->count() > 0;
    }


}
?>