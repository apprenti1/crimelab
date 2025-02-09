# Cahier des Charges - Projet CrimeLab

## Sommaire

* [Contexte](#1-contexte)
* [Objectifs](#2-objectifs)
* [Fonctionnalités](#3-fonctionnalités)
* [Technologies](#4-technologies)
* [Installation](#5-installation)
* [Utilisation](#6-utilisation)
* [Auteurs](#7-auteurs)

## 1. Contexte
Dans le cadre de la digitalisation des enquêtes criminelles, nous développons un outil d'analyse criminelle basé sur **Neo4J**, **MongoDB**, et un langage de programmation au choix (**Python, Node.js, Dart, PHP...**). Cet outil a pour objectif de faciliter le traitement et l'analyse des affaires criminelles en centralisant diverses informations.

## 2. Objectifs
L'outil CrimeLab permettra :
- De recenser les **affaires criminelles**.
- De suivre les **individus** impliqués (suspects, témoins, victimes, etc.).
- De cartographier les **lieux** impliqués dans les enquêtes.
- De centraliser les **témoignages** et les **fadettes téléphoniques**.
- D'établir des **connexions et relations** entre ces éléments pour faciliter les investigations.

## 3. Fonctionnalités principales
### a) Gestion des Affaires
- Création, mise à jour et consultation des affaires.
- Association des individus, lieux et preuves à une affaire.

### b) Suivi des Individus
- Enregistrement des suspects, témoins et victimes.
- Suivi des appels et messages via l'analyse des fadettes.
- Localisation des individus grâce aux bornes téléphoniques.

### c) Gestion des Lieux
- Stockage des adresses et coordonnées géographiques.
- Association des lieux aux affaires et individus.

### d) Exploitation des Témoignages
- Enregistrement des déclarations des témoins.
- Association des témoignages aux affaires et individus concernés.

### e) Analyse des Fadettes
- Stockage des communications téléphoniques (émetteur, récepteur, durée, borne téléphonique utilisée).
- Reconstruction des réseaux de relations entre suspects.
- Croisement des données avec la localisation des bornes téléphoniques.

## 4. Technologies
- **Base de données NoSQL :** MongoDB pour stocker les données textuelles et documentaires.
- **Base de données graphe :** Neo4J pour modéliser et analyser les relations entre individus, lieux et événements.
- **Langage de programmation :** Python / Node.js / PHP / Dart (à définir selon le choix de l'équipe).
- **Gestion des versions :** GitHub/GitLab.

## 5. Répartition des données entre MongoDB et Neo4J

Certaines données seront stockées sur **MongoDB**, tandis que d'autres seront gérées dans **Neo4J** pour optimiser les requêtes et relations complexes.

- **MongoDB :**
  - Affaires
  - Témoignages
  - Détails des individus (informations générales)
  - Lieux (données statiques)
  - Fadettes (enregistrement brut des appels et métadonnées)

- **Neo4J :**
  - Relations entre individus (contacts téléphoniques, interactions dans les affaires...)
  - Présence d’individus sur des lieux
  - Réseau de liens entre suspects via fadettes
  - Associations entre affaires, individus et lieux

## 6. Modélisation des Données

### a) Modèle de données pour **MongoDB**
MongoDB sera utilisé pour stocker des données sous forme de documents JSON.

#### **Collections et structure :**

1. **affaires**
```json
{
    "_id": ObjectId,
    "titre": "Cambriolage Parking",
    "description": "Vol d'une voiture dans un parking",
    "date": "2024-02-09",
    "lieux": [ObjectId],
    "individus": [ObjectId],
    "temoignages": [ObjectId],
    "fadettes": [ObjectId]
}
```

2. **individus**
```json
{
    "_id": ObjectId,
    "nom": "Dupont",
    "prenom": "Jean",
    "statut": "suspect",
    "telephone": "0601020304",
    "adresse": "10 rue des Lilas, Paris",
    "affaires": [ObjectId]
}
```

3. **lieux**
```json
{
    "_id": ObjectId,
    "nom": "Parking Central",
    "adresse": "5 Avenue de la République, Paris",
    "coordonnees": { "lat": 48.8566, "lng": 2.3522 },
    "affaires": [ObjectId]
}
```

4. **temoignages**
```json
{
    "_id": ObjectId,
    "temoin": ObjectId,
    "description": "J’ai vu une personne s’enfuir avec un sac.",
    "date": "2024-02-09",
    "lieu": ObjectId
}
```

5. **fadettes**
```json
{
    "_id": ObjectId,
    "individu": ObjectId,
    "appelants": [
        { "numero": "0611223344", "date": "2024-02-09T10:30:00", "antenne": "75001_A1" },
        { "numero": "0655667788", "date": "2024-02-09T11:00:00", "antenne": "75002_B3" }
    ]
}
```

### b) Modèle de données pour **Neo4J**
Neo4J sera utilisé pour gérer les relations et connexions entre individus, affaires, lieux, etc.

#### **Noeuds principaux :**
- **(Affaire {id, titre, description, date})**
- **(Individu {id, nom, prenom, statut, telephone})**
- **(Lieu {id, nom, adresse, lat, lng})**
- **(Temoignage {id, description, date})**
- **(Fadette {id, individu_id})**

#### **Relations entre les nœuds :**
- `(INDIVIDU)-[:IMPLIQUE]->(AFFAIRE)`
- `(INDIVIDU)-[:APPELE]->(INDIVIDU)` (avec une propriété de date et borne téléphonique)
- `(INDIVIDU)-[:PRESENT_A]->(LIEU)` (via les bornes téléphoniques)
- `(TEMOIGNAGE)-[:CONCERNE]->(INDIVIDU)`
- `(AFFAIRE)-[:LIE_A]->(LIEU)`

#### détail de la répartition des données :
J’ai réparti les données entre **MongoDB** et **Neo4J** en fonction de la nature des informations et des types de requêtes les plus efficaces pour chaque technologie :

1. **MongoDB** est une base NoSQL orientée document, idéale pour :
   - Stocker des données **structurées mais flexibles** sous forme de documents JSON.
   - Gérer les **affaires, individus, témoignages et fadettes** qui sont principalement des ensembles de données indépendants, souvent consultés via des filtres simples ou des agrégations.

2. **Neo4J** est une base de données orientée graphe, parfaite pour :
   - Modéliser des **relations complexes** et effectuer des **requêtes performantes sur les liens** entre les entités.
   - Gérer les **relations entre individus, lieux et appels** pour reconstituer des **réseaux criminels**.
   - Effectuer des requêtes comme *"Qui était en contact avec qui ?"*, *"Quels suspects étaient présents à proximité d’un crime au même moment ?"*, ce qui est bien plus rapide en graphe.

En résumé :
- **Données statiques et documentaires → MongoDB**  
- **Données relationnelles et connectées → Neo4J**  

Cette approche permet d’optimiser à la fois le stockage et les performances des requêtes analytiques 🔥.

## 7. Conclusion
Le projet CrimeLab vise à fournir un outil performant pour aider les forces de l’ordre dans l’analyse des enquêtes criminelles. La combinaison de **MongoDB** pour la gestion des documents et de **Neo4J** pour l’analyse des connexions garantit une exploitation optimale des données d’enquête.

## 8. Auteurs
- **le ti loup du groupe :** [Elias AIT BOUKHA (letiloup / Ethan HAINU)](https://github.com/apptenti1)
- **Auteur 2 :** [Nom 2](https://github.com/username2)
- **Auteur 3 :** [Nom 3](https://github.com/username3)