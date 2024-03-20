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
    <title>Prepare avec paramètres via execute()</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Prepare avec paramètres via execute()</h1>
    <?php include "menu.php" ?>
    <p>L'utilisation la plus courante, mise à part que les dev préfèrent les marqueurs ?.</p>
    <h2>Les marqueurs nommés</h2>
    <form action="" method="POST" name="first">
        Choisissez entre l'id
        <input type="number" name="num1" required>
        et l'id <input type="number" name="num2" required>
        <input type="submit" value="Sélectionnez">
    </form>

    <?php

    if(isset($_POST['num1'],$_POST['num2'])){
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
    }else{
        $num1= 1;
        $num2= 2;
    }
    // Intégrité de la DB en péril !
    //$recup = $PDOConnect->query("SELECT * FROM countries WHERE id BETWEEN $num1 AND $num2");

    // requête sans entrée utilisateur avec marqueur nommé
    $sql = "SELECT * FROM countries WHERE id BETWEEN :lid AND :lid2 LIMIT :debut , :fin";
    // on prépare la requête
    $query = $PDOConnect->prepare($sql);

    // on utilise le try catch sur l'execute
    try{
        // exécution de la requête du prepare en passant les paramètres par la méthode par défaut = bindValue. en passant un tableau associatif - problèmes de LIMIT, ne peut être utilisé sans $query->bindValue(..., PDO::PARAM_INT)
        $query->execute(["lid"=>$num1,
                        "lid2"=>$num2,
                        "debut"=>0,
                        "fin"=>10,
    ]);
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
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
    }else{
        $num1= 1;
        $num2= 2;
    }
    // Intégrité de la DB en péril !
    //$recup = $PDOConnect->query("SELECT * FROM countries WHERE id BETWEEN $num1 AND $num2");

    // requête sans entrée utilisateur avec marqueur nommé
    $sql = "SELECT * FROM countries WHERE id BETWEEN :lid AND :lid2 LIMIT :debut , :fin";
    // on prépare la requête
    $query = $PDOConnect->prepare($sql);

    // on utilise le try catch sur l'execute
    try{
        // exécution de la requête du prepare en passant les paramètres par la méthode par défaut = bindValue. en passant un tableau associatif - problèmes de LIMIT, ne peut être utilisé sans $query->bindValue(..., PDO::PARAM_INT)
        $query->execute(["lid"=>$num1,
                        "lid2"=>$num2,
                        "debut"=>0,
                        "fin"=>10,
    ]);
        // récupération des résultats
        $results = $query->fetchAll();
    }catch(Exception $e){
        // affichage de l'erreur
        echo $e->getMessage();
    }
    echo $query->rowCount();
    var_dump($_POST,$results);
    </pre>
    </code>
</body>
</html>
