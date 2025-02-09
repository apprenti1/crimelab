<?php
//LogicController

$client = Utilities::connectMongoDB();
$collection = $client->test->users;
$data = [ 
    'nom' => 'John Doe', 
    'email' => 'john@example.com', 
    'age' => 30 
]; 
$result = $collection->insertOne($data); 
echo "Document ins r  avec ID : " . $result->getInsertedId();
$template = '../template/home/index.php';
require '../template/base.php';
?>