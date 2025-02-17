<?php

//require_once __DIR__.'/../vendor/autoload.php';

use MongoDB\Client;

$client = Utilities::connectMongoDB();
$db = $client->CrimeLab;

$affairesCollection = $db->createCollection("affaires");
$temoignagesCollection = $db->createCollection("temoignages");
$lieuxCollection = $db->createCollection("lieux");
$individusCollection = $db->createCollection("individus");
$communicationsCollection = $db->createCollection("communications");


echo "Collections MongoDB créés.\n";

/*

$neo4jClient = Utilities::connectNeo4j()->createSession();

$result = $neo4jClient->run('SHOW DATABASES');

if ($result->count() <= 2) {
    $neo4jClient->run('CREATE DATABASE CrimeLab');
    echo "Base de données Neo4J créée.\n";
} else {
    echo "Base de données Neo4J existante. Aucune modification n'a été apportée.\n";
}
$neo4jClient = Utilities::connectNeo4j()->createSession();

$result = $neo4jClient->run('SHOW DATABASES');

if ($result->count() > 0) {
    echo "Base de données Neo4J existante. Aucune modification n'a été apportée.\n";
} else {

$neo4jClient->run('CREATE CONSTRAINT FOR (a:Affaire) REQUIRE a.id IS UNIQUE');
$neo4jClient->run('CREATE CONSTRAINT FOR (t:Temoignage) REQUIRE t.id IS UNIQUE');
$neo4jClient->run('CREATE CONSTRAINT FOR (l:Lieu) REQUIRE l.id IS UNIQUE');
$neo4jClient->run('CREATE CONSTRAINT FOR (i:Individu) REQUIRE i.id IS UNIQUE');
$neo4jClient->run('CREATE CONSTRAINT FOR (c:Communication) REQUIRE c.id IS UNIQUE');
}

echo "Contraintes Neo4j créées.\n";
*/