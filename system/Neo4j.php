<?php

require 'vendor/autoload.php';

use Laudis\Neo4j\ClientBuilder;



$client = ClientBuilder::create()
    ->withDriver('neo4j', 'bolt://neo4j:password@localhost:7687') // Remplace par tes credentials
    ->build();

// Test de connexion
$result = $client->run('RETURN "Hello, Neo4j!" AS message');

foreach ($result as $record) {
    echo $record->get('message') . PHP_EOL;
}