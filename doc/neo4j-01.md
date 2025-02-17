# Découverte
´´´cypher

--create
CREATE (n: Person {name:"Richnou"}) return n;

CREATE (n: City {name: "Paris"}) return n;

--search
MATCH (n: Person {name:"Toto"}) return n;

--update
MATCH (n: Person {name:"Toto"}) SET n.age = 25, n.genre = "H";

--delete
MATCH (n) DETACH DELETE n;

MATCH (n: Person {name:"Toto"}) REMOVE n.age;

MATCH (n: Person {name: "Titi"}) DELETE n;

MATCH (n: Person {name: "Titi"}) DETACH DELETE n;

--select
MATCH (n) return n;

--attach
MATCH 
    (p1: Person {name: "Amandine"}) ,
    (p2: Person {name: "Calvin"})
MERGE
    (p1)-[r:FRIEND]->(p2)
;

MATCH 
    (p1: Person {name: "Amandine"}) ,
    (p2: Person {name: "Calvin"})
MERGE
    (p1)-[r:MARRIED {since:"2020"}]->(p2)
;

// visualize the graph : http://localhost:7474/browser

// sharemycode.fr/9fi
MATCH (p1:Person), (p2:Person)
    WHERE p1 <> p2 AND LOWER(p1.name) CONTAINS "ric" AND LOWER(p2.name)
    CONTAINS "ric"
    CREATE (p1)-[r:FRIENDS_WITH]->(p2);

// delete the link between two person
MATCH (p3:Person {name:"Calvin"})-[r:HATE]->(b:Person{name:Erminio}) DELETE r;
´´´

# Requêtage

´´´cypher
MATCH (n:Person) WHERE n.name="Calvin"
    RETURN n;

MATCH (n:Person) WHERE n.name="Calvin"
    RETURN n.name;

MATCH (n:Person)
    WHERE n.name="Calvin" OR n.name="Amandine"
    RETURN n;

MATCH (n:Person)
    WHERE n.name CONTAINS "ine"
    RETURN n;

MATCH
    (n:Person {name:"Calvin"})-[:FRIEND]->(p:Person)
    RETURN n, p;

MATCH
    (n:Person{name:"Calvin"})<-[:FRIEND]-(p:Person)
    RETURN n.name, p.name;

MATCH (p1:Person)-[r:FRIEND]-(p2:Person)
    RETURN p1, r, p2;

MATCH
    (start:Person {name:"Erminio"}),
    (end:Person {name:"Amandine"}),
    path = shortestPath((start)-[*]-(end))
RETURN path;

// retourne la personne qui a le plus de relations
MATCH (n:Person)-[r]-()
    WITH n, COUNT(r) AS numRelations
    ORDER BY numRelations DESC
    LIMIT 1
    RETURN n, numRelations;

MATCH (p:Person {name:"Amandine"}) DELETE p;

MATCH (p:Person {name:"Amandine"})-[r]-(x) DELETE r;

´´´

# Relations avec pondération

´´´cypher

MATCH (c:City)-[r:TRIP]->(d:City)
    RETURN c.name AS From, d.name AS To, r.distance AS Distance;

// Trouver la ville avec le plus de connections
MATCH (c:City)-[r:TRIP]->(d:City)
    WITH c, COUNT(r) AS degree
    ORDER BY degree DESC
    LIMIT 10
    RETURN c.name AS City, degree AS Degree;

// chemin le plus court en nombre d'étapes
MATCH (start:City {name:"Brest"}), (end:City {name:"Nice"})
    MATCH path = shortestPath((start)-[:TRIP*]-(end))
    RETURN [n IN nodes(path) | n.name] AS Steps,
        reduce(total = 0, r IN relationships(path) | total + toInteger(r.distance)) as total;



´´´