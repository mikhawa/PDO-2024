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
    <title>Prepare | bindParam vs bindValue</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Prepare | bindParam vs bindValue</h1>
    <?php include "menu.php" ?>
    <p>Une requête sans entrés utilisateurs dans un prepare n'a que peu d'intérêt, mis à part la gestion du cache qui peut être améliorée.</p>
    <h2>bindParam</h2>
    <p>Met en paramètre la valeur d'une variable qui sera gardée comme référence (&$var), pour pouvoir modifier cette variable de la requête préparée (gain de temps pour les tâches répétitives)</p>
<code>
    <pre>
   
    </pre>
</code>
    <?php
   $query = $PDOConnect->prepare("SELECT * FROM countries WHERE id BETWEEN ? AND ?");
   $prems=5;$dems =15;
   $query->bindParam(1, $prems, PDO::PARAM_INT);
   $query->bindParam(2, $dems, PDO::PARAM_INT);
   $query->execute();
   echo $query->rowCount()."<br>";

   // on change la valeur des variables passées en référence 
   $prems=10;$dems =25;
   // la requête prend en compte le changement des variables Avant d'exécuté la requête
   $query->execute();
   echo $query->rowCount()."<br>";

   $prems=10;$dems =35;
   $query->execute();
   echo $query->rowCount()."<br>";
    ?>
</body>
</html>
