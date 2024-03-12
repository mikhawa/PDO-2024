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
</head>
<body>
    <h1>Prepare simple</h1>
    <?php include "menu.php" ?>

    <?php
    // requête sans entrée utilisateur
    $sql = "SELECT * FROM countries";
    // on prépare la requête
    $query = $PDOConnect->prepare($sql);

    // on utilise le try catch sur l'execute
    try{
        // exécution de la requête du prepare
        $query->execute();
    }catch(Exception $e){

    }

    ?>
</body>
</html>
