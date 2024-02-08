# PDO-2024
Cours PHP:  PDO - MySQL - MariaDB

## PDO : Présentation

`PDO` est l'acronyme de `PHP Data Objects`. C'est une extension PHP qui définit une interface pour accéder à une base de données depuis PHP. 

Cette extension présente l'avantage de supporter de nombreux `SGBD` (`MySQL`, `PostgreSQL`, `Oracle`, etc.) en utilisant une unique interface. 

Cette interface est **orientée objet**, et est une couche d'abstraction qui permet de s'affranchir des spécificités de chaque `SGBD` (système de gestion de base de données).

**PDO** est disponible depuis PHP 5.1.* . Il est recommandé d'utiliser PDO pour accéder à une base de données en `MySQL` ou `MariaDB`. En effet, l'extension `mysql_` est obsolète depuis PHP 5.5.0 et sera supprimée dans une version future de PHP. L'extension `mysqli_` est une alternative `procédurale et/ou orienté objet` à `mysql_`, mais PDO est plus simple à utiliser.

Pour voir les différences entre les extensions `mysql_` (obsolète), `mysqli_` et `PDO`, vous pouvez consulter le [comparatif](https://www.php.net/manual/fr/mysqlinfo.api.choosing.php) sur le site officiel de PHP.

## PDO : Installation

PDO est une extension de PHP, il faut donc l'installer et l'activer pour pouvoir l'utiliser. Pour cela, il faut modifier le fichier php.ini de votre serveur. Il faut rechercher la ligne suivante :

```ini
;extension=php_pdo_mysql.dll
```

Et la décommenter en supprimant le point-virgule :

```ini
extension=php_pdo_mysql.dll
```

PDO est généralement installé par défaut avec PHP.

## PDO : Connexion à la base de données

Pour se connecter à une base de données, il faut utiliser la classe `PDO` et lui passer en paramètre les informations de connexion à la base de données. On utilise le mot-clé `new` pour **instancier** un **objet** de la **classe** `PDO` :

```php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=nom_de_la_base_de_donnees', 
    'nom_utilisateur', 
    'mot_de_passe'
);

// requête SQL
$sql = "SELECT * FROM `table`";

// Exécution de la requête SQL
$query = $pdo->query($sql);

// récupération des résultats
$results = $query->fetchAll(PDO::FETCH_ASSOC);

// etc ...

// fermeture de la requête
$query->closeCursor();

// effacement des résultats
$results = null;

// fermeture de la connexion
$pdo = null;
``` 

Pour la suite de la partie théorie de ce cours, j'ai créé un .pdf que vous pouvez télécharger [ici](https://github.com/WebDevCF2m2023/PDO-2024/blob/main/datas/PDO.pdf).

## PDO : Exercices

Nous allons maintenant mettre en pratique ce que nous avons vu dans la partie théorique. N'oubliez pas de créer un dossier à votre nom dans `stagiaires` et d'y mettre vos fichiers.

Ouvrez PHPMyAdmin, sélectionnez `MariaDB` et importez la base de données `listepays.sql` qui se trouve dans le dossier `datas` de ce dépôt.

## Création d'un nouveau projet

### Public sur Github

- Création du projet sur Github sur votre compte
- Si c'est une copie d'un projet existant :  création d'un **fork¨** sur votre compte
- **Clonage** de **votre** projet ou fork en local
- On se met dans le projet (cd NomDuProjet) : origin/main existe déjà
- Création de l'**upstream** pour renvoyer le projet via des **pull request** :
`git remote add upstream SSH_KEY`
- Création d'un `.gitignore` en y plaçant les liens versz les fichiers que l'on ne souhaite pas envoyer sur Git (et donc Github) dont le **fichier de configuration** contenant les **constantes de connexion**
- faites des **commit** régulièrement
- Création (ou Sauvegarder sous en `.php` si un modèle existe) du fichier de configuration pour la connexion à la DB
- Importation ou création de la DB suivant la demande (PHPMyAdmin)
- Création des 3 dossiers MVC
    - M : model (Gestion des données)
    - V : view (Gestion des templates)
    - C : controller (Routage et lien entre les données et les templates)
- Création du dossier `public`, qui contiendra `index.php` (Contrôleur Frontal), les fichiers CSS, JS (front), images etc...
- Création d'un hôte virtuel vers le dossier `public` (qui afficher donc `index.php`)
- Dans index.php :
    - chargemement des dépendances (dont la configuration, les **fonctions** utilisées (`model`))
    - Connexion **PDO** (non permanente)
    - Routage : Appel des fonctions utilisées suivies des vues (`view`) suivant l'URL ($_GET et/ou $_POST)
