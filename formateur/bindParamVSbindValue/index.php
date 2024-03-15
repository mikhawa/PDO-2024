<?php

require_once "config.php";
require_once "PDOConnect.php";



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bindValue VS bindParam</title>
</head>
<body>
    <h1>bindValue VS bindParam</h1>
    <h2>bindValue</h2>
    <p>C'est l'action du prepare() par défault, c'est lui qui est utilisé dans un execute()</p>
    <p>On peut le rendre plus stricte avec bindValue()</p>
    <p>En cas de requêtes mutlitple, il faudra repréparé la requête après chaque execute(), sauf en cas de passage des données directement dans l'execute !</p>
    <?php
$petit = 1;
$grand = 500_000;
$request = $PDOConnect->prepare("SELECT `nom`, `population` FROM `countries` WHERE `population` BETWEEN ? AND ? ORDER BY `population` DESC ;");
$request->bindValue(1,$petit,PDO::PARAM_INT);
$request->bindValue(2,$grand,PDO::PARAM_INT);
try{
    $request->execute();
    $resultats = $request->fetchAll();
}catch(Exception $e){
    die($e->getMessage());
}
var_dump($resultats);
echo "<hr>";
$petit=10_000;
$grand= 200_000;
$request = $PDOConnect->prepare("SELECT `nom`, `population` FROM `countries` WHERE `population` BETWEEN ? AND ? ORDER BY `population` DESC ;");
$request->bindValue(1,$petit,PDO::PARAM_INT);
$request->bindValue(2,$grand,PDO::PARAM_INT);
$request->execute();
$resultats2 = $request->fetchAll();
var_dump($resultats2);
echo "<hr>";
    ?>
    <h2>bindParam</h2>
    <p>BindParam n'accepte que des variable car elles sont passées par référence (&$var)</p>
    <p>On doit l'utiliser strictement avec bindParam()</p>
    <p>En cas de requêtes multiple, requête est mémorisée et réévaluée et réutilisée à chaque execute !</p>
    <?php
$petit = 1;
$grand = 500_000;

$request = $PDOConnect->prepare("SELECT `nom`, `population` FROM `countries` WHERE `population` BETWEEN ? AND ? ORDER BY `population` DESC ;");
$request->bindParam(1,$petit,PDO::PARAM_INT);
$request->bindParam(2,$grand,PDO::PARAM_INT);

$request->execute();
$bindParam = $request->fetchAll();
var_dump($bindParam);

$petit = 100_500;
$grand = 500_000;
$request->execute();
echo $request->rowCount();
echo "<hr>";
$petit = 100_500;
$grand = 1_000_000;
$request->execute();
echo $request->rowCount();
echo "<hr>";
$petit = 100_500;
$grand = 2_000_000;
$request->execute();
echo $request->rowCount();
echo "<hr>";
?>
</body>
</html>