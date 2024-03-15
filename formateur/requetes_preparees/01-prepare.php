<?php
require_once "config.php";
require_once "PDOConnect.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prepare simple</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Prepare simple</h1>
    <?php include "menu.php" ?>
    <p>Une requête sans entrés utilisateurs dans un prepare n'a que peu d'intérêt, mis à part la gestion du cache qui peut être améliorée.</p>
<code>
    <pre>
    // requête sans entrée utilisateur
    $sql = "SELECT * FROM countries";

    // on prépare la requête
    $query = $PDOConnect->prepare($sql);

    // on utilise le try catch sur l'execute
    try{
        // exécution de la requête du prepare
        $query->execute();

        // récupération des résultats
        $results = $query->fetchAll();

    }catch(Exception $e){

        // affichage de l'erreur
        echo $e->getMessage();
    }

    echo $query->rowCount();
    </pre>
</code>
    <?php
    // requête sans entrée utilisateur
    $sql = "SELECT * FROM countries";
    // on prépare la requête
    $query = $PDOConnect->prepare($sql);

    // on utilise le try catch sur l'execute
    try{
        // exécution de la requête du prepare
        $query->execute();
        // récupération des résultats
        $results = $query->fetchAll();
    }catch(Exception $e){
        // affichage de l'erreur
        echo $e->getMessage();
    }
echo $query->rowCount();
    var_dump($results);
    ?>
</body>
</html>
