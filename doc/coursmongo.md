### 🌍 **Introduction à MongoDB**

MongoDB est une base de données NoSQL qui stocke les données sous forme de **documents** JSON, au lieu des lignes et colonnes typiques des bases de données relationnelles. Ces documents sont regroupés dans des **collections** au lieu des tables.

MongoDB est souvent utilisé pour des applications nécessitant une grande évolutivité et flexibilité.

### 📚 **Terminologie de MongoDB**

- **Base de données (Database)** : Un ensemble de collections.
- **Collection** : Un ensemble de documents, similaire à une table en SQL.
- **Document** : Un enregistrement individuel dans une collection, semblable à une ligne dans une table SQL. C'est un objet JSON.
- **Champ** : Une clé dans un document (ex: "nom" dans un document représentant une personne).

---

### 🛠️ **Se connecter à MongoDB via `mongosh`**

1. **Lancer MongoDB Shell (mongosh)**
   Si tu es déjà dans le shell, tape la commande suivante pour te connecter à MongoDB :

   ```bash
   mongosh -u admin -p password --authenticationDatabase admin
   ```

   Cela te connecte à MongoDB avec les identifiants administrateur.

2. **Se connecter à une base de données spécifique**
   Pour passer à une base de données spécifique, utilise la commande suivante :

   ```bash
   use nom_de_la_base_de_donnees
   ```

   Exemple :
   ```bash
   use test
   ```

   Si la base de données n'existe pas, MongoDB en créera une automatiquement dès que tu y inséreras des données.

---

### 📌 **Créer une base de données**

MongoDB crée automatiquement une base de données dès que tu y insères des données. Voici comment créer une base de données et une collection :

1. **Créer une base de données :**

   Passons à la base de données `test` (si elle n'existe pas déjà, elle sera créée à l'insertion de données) :

   ```bash
   use test
   ```

2. **Créer une collection** :

   Une collection est une sorte de "table" dans MongoDB, mais elle peut contenir des documents de différents formats.

   Pour insérer un document dans une collection, MongoDB crée automatiquement la collection si elle n'existe pas.

---

### 📌 **Insérer des données dans MongoDB**

1. **Insérer un document dans une collection :**

   MongoDB utilise une méthode appelée `insertOne()` pour insérer un seul document et `insertMany()` pour insérer plusieurs documents.

   Exemple d'insertion d'un document dans la collection `utilisateurs` :

   ```javascript
   db.utilisateurs.insertOne({
     nom: "Jean",
     age: 28,
     email: "jean@example.com"
   })
   ```

2. **Insérer plusieurs documents :**

   Exemple avec `insertMany()` :

   ```javascript
   db.utilisateurs.insertMany([
     { nom: "Marie", age: 34, email: "marie@example.com" },
     { nom: "Pierre", age: 45, email: "pierre@example.com" }
   ])
   ```

---

### 📌 **Récupérer des données**

1. **Récupérer tous les documents d'une collection :**

   La méthode `find()` permet de récupérer tous les documents d'une collection.

   Exemple pour récupérer tous les utilisateurs :

   ```javascript
   db.utilisateurs.find()
   ```

2. **Récupérer un seul document :**

   Si tu veux récupérer un seul document correspondant à une condition spécifique, utilise `findOne()`.

   Exemple pour récupérer un utilisateur par son email :

   ```javascript
   db.utilisateurs.findOne({ email: "jean@example.com" })
   ```

3. **Filtrer les données avec `find()` :**

   Exemple de recherche d’utilisateurs ayant plus de 30 ans :

   ```javascript
   db.utilisateurs.find({ age: { $gt: 30 } })
   ```

   `$gt` signifie "greater than" (plus grand que).

---

### 📌 **Modifier des données**

1. **Modifier un document avec `updateOne()` :**

   Pour mettre à jour un seul document correspondant à une condition :

   Exemple pour mettre à jour l'email de Jean :

   ```javascript
   db.utilisateurs.updateOne(
     { nom: "Jean" },
     { $set: { email: "new-jean@example.com" } }
   )
   ```

   - Le premier argument est la condition (par exemple, `nom: "Jean"`).
   - Le deuxième argument spécifie ce que tu veux modifier, ici le champ `email`.

2. **Modifier plusieurs documents avec `updateMany()` :**

   Pour mettre à jour plusieurs documents :

   Exemple pour augmenter l'âge de tous les utilisateurs de plus de 30 ans :

   ```javascript
   db.utilisateurs.updateMany(
     { age: { $gt: 30 } },
     { $inc: { age: 1 } }  // $inc pour incrémenter un champ
   )
   ```

---

### 📌 **Supprimer des données**

1. **Supprimer un document avec `deleteOne()` :**

   Exemple pour supprimer un utilisateur nommé "Pierre" :

   ```javascript
   db.utilisateurs.deleteOne({ nom: "Pierre" })
   ```

2. **Supprimer plusieurs documents avec `deleteMany()` :**

   Exemple pour supprimer tous les utilisateurs âgés de moins de 30 ans :

   ```javascript
   db.utilisateurs.deleteMany({ age: { $lt: 30 } })
   ```

---

### 📌 **Supprimer une base de données ou une collection**

1. **Supprimer une base de données :**

   Pour supprimer une base de données, il faut d'abord s'assurer d'être dans la base à supprimer, puis utiliser la commande :

   ```javascript
   db.dropDatabase()
   ```

2. **Supprimer une collection :**

   Pour supprimer une collection :

   ```javascript
   db.utilisateurs.drop()
   ```

---

### 🔄 **Exemples supplémentaires**

- **Opérateurs MongoDB :**
  - `$eq` : égal
  - `$gt` : plus grand que
  - `$lt` : moins que
  - `$in` : dans un tableau de valeurs

Exemple de recherche de tous les utilisateurs dont l'âge est supérieur à 30 et inférieur à 50 :

```javascript
db.utilisateurs.find({ age: { $gt: 30, $lt: 50 } })
```

---

### 📜 **Résumé des commandes courantes MongoDB**

| Commande                        | Description                                      |
|----------------------------------|--------------------------------------------------|
| `use <db>`                       | Se connecter ou créer une base de données.       |
| `db.createCollection(name)`      | Créer une collection.                           |
| `db.<collection>.insertOne(doc)`  | Insérer un document dans une collection.         |
| `db.<collection>.insertMany(docs)`| Insérer plusieurs documents dans une collection.|
| `db.<collection>.find()`         | Récupérer tous les documents d'une collection.   |
| `db.<collection>.findOne(query)` | Récupérer un document qui correspond à une condition. |
| `db.<collection>.updateOne()`    | Mettre à jour un document.                      |
| `db.<collection>.deleteOne()`    | Supprimer un document.                          |
| `db.dropDatabase()`              | Supprimer une base de données.                  |
| `db.<collection>.drop()`         | Supprimer une collection.                       |

---

### Conclusion

Voilà un résumé des principales commandes de MongoDB !