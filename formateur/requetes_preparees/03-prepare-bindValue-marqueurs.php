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
    <title>Prepare avec bindValue</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Prepare avec bindValue</h1>
    <?php include "menu.php" ?>
    <p>L'utilisation de bindValue est la plus utilisée dans les requêtes préparées. Elle n'est pourtant pas la meilleure lorsqu'il s'agit d'automatisation.</p>
    <h2>Les marqueurs ?</h2>
    <form action="" method="POST" name="first">
        Choisissez entre l'id
        <input type="number" name="num1" required>
        et l'id <input type="number" name="num2" required>
        <input type="submit" value="Sélectionnez">
    </form>

    <?php

    if(isset($_POST['num1'],$_POST['num2'])){
        $num1 = (int)$_POST['num1'];
        $num2 = (int)$_POST['num2'];
    }else{
        $num1= 1;
        $num2= 2;
    }

    $sql ="SELECT * FROM countries WHERE id BETWEEN ? AND ?"    ;

    // on prépare la requête
    $query = $PDOConnect->prepare($sql);

    // bindValue avec des numériques dans l'ordre de gauche à droite et de haut en bas, commence à 1
    $query->bindValue(1,$num1, PDO::PARAM_INT);
    $query->bindValue(2,$num2,PDO::PARAM_INT);
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
    var_dump($_POST,$results);
    ?>
    <hr>
    <code>
    <pre>if(isset($_POST['num1'],$_POST['num2'])){
        $num1 = (int)$_POST['num1'];
        $num2 = (int)$_POST['num2'];
    }else{
        $num1= 1;
        $num2= 2;
    }
    // Intégrité de la DB en péril !
    $recup = $PDOConnect->query("SELECT * FROM countries WHERE id BETWEEN ? AND ?");

    // on prépare la requête
    $query = $PDOConnect->prepare($sql);

    // bindValue avec des numériques dans l'ordre de gauche à droite et de haut en bas, commence à 1
    $query->bindValue(1,$num1, PDO::PARAM_INT);
    $query->bindValue(2,$num2,PDO::PARAM_INT);
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
</body>
</html>
