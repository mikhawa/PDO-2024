<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à PDO</title>
</head>
<body>
    <h1>Connexion avec PDO</h1>
    <?php

// $db est un lien (flag, drapeau) vers l'instanciation d'un objet de la classe PDO
$db = new PDO("mysql:host=localhost;port=3307;dbname=listepays;charset=utf8mb4;", // type, chemin et nom de la DB
              "root", // login
              ""); // mot de passe

// on sélectionne tout de la table countries - SELECT => query              
$firstQuery = $db->query("SELECT * FROM countries;");  

// on va afficher le nombre d'éléments récupérés grâce à la méthode rowCount()
echo "<h3>Il y a ".$firstQuery->rowCount()." pays dans la table countries</h3>";

// on doit formater les résultats pour que PHP sache comment les utiliser
// ici fetchAll crée un tableau indexé contenant les valeurs au format
// PDO::FETCH_ASSOC => tableau associatif
$resultFirstQuery = $firstQuery->fetchAll(PDO::FETCH_ASSOC);

// tant qu'on a des résultats
foreach($resultFirstQuery as $item){
    echo $item['nom'].", ";
}

var_dump($db,$firstQuery,$resultFirstQuery);
// fermeture bonne pratique
$db = null;
    ?>
</body>
</html>