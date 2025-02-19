<?php
//LogicController

require_once Utilities::$basepath.'src/entity/Affaire.php';
require_once Utilities::$basepath.'src/repo/mongo/AffaireRepositoryMongo.php';


$affaireRepository = new AffaireRepository();
$affaire = new Affaire(null, 'Affaire 1', 'Affaire 1', 'Description de l\'affaire 1', '2021-01-01', 'Paris', ['Individu 1', 'Individu 2'], ['Temoignage 1', 'Temoignage 2'], ['Fadette 1', 'Fadette 2']);
$affaireRepository->insertAffaire($affaire);

$test = $affaireRepository->findAffaireById('67aa00fb52d064e4470a9436');

$client = Utilities::connectMongoDB();
$clientneo = Utilities::connectNeo4j();

$session = $clientneo->createSession();
$result = $session->run("MATCH (n) WHERE n.name IS NOT NULL RETURN DISTINCT 'node' as entity, n.name AS name LIMIT 25 UNION ALL MATCH ()-[r]-() WHERE r.name IS NOT NULL RETURN DISTINCT 'relationship' AS entity, r.name AS name LIMIT 25");
// var_dump($result[0]);
        
$collection = $client->test->users;
$data = [ 
    'nom' => 'John Doe', 
    'email' => 'john@example.com', 
    'age' => 30 
]; 
$result = $collection->insertOne($data); 
echo "Document ins r  avec ID : " . $result->getInsertedId();


$title = 'Accueil';
$template = Utilities::$basepath.'template/home/index.php';
require Utilities::$basepath.'template/base.php';
?>