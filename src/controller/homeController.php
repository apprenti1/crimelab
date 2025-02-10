<?php
//LogicController
require_once Utilities::$basepath.'src/entity/Affaire.php';
require_once Utilities::$basepath.'src/repo/mongo/AffaireRepository.php';
$affaireRepository = new AffaireRepository();
$affaire = new Affaire(null, 'Affaire 1', 'Affaire 1', 'Description de l\'affaire 1', '2021-01-01', [], [], [], []);
$affaireRepository->insertAffaire($affaire);
$test = $affaireRepository->findAffaireById('67aa00fb52d064e4470a9436');
/* 
*/

$client = Utilities::connectMongoDB();
$collection = $client->test->users;
$data = [ 
    'nom' => 'John Doe', 
    'email' => 'john@example.com', 
    'age' => 30 
]; 
$result = $collection->insertOne($data); 
echo "Document ins r  avec ID : " . $result->getInsertedId();
$template = Utilities::$basepath.'template/home/index.php';
require Utilities::$basepath.'template/base.php';
?>