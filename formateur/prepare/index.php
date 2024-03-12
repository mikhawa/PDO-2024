<?php

require_once "config.php";
require_once "PDOConnect.php";


/*
Requêtes préparées :
- protection contre les injections SQL
- mise en cache de la requête
- réutilisation multiple de la requête
*/

// Premier bindParam avec marqueurs ?
if(isset($_POST['num1'],$_POST['num2'])):


// Préparation de notre requête avec prepare et les marqueurs ?
$request = $PDOConnect->prepare("SELECT `nom`, `population` FROM `countries` WHERE `population` BETWEEN ? AND ? ORDER BY `population` DESC ;");

// utilisation de bindValue(), version plus longue, mais plus stricte que le tableau dans l'execute(). 1 représente le premier ? dans l'ordre de lecture (de haut en bas gauche à droite)
$request->bindValue(1,$_POST['num1'],PDO::PARAM_INT);
$request->bindValue(2,$_POST['num2'],PDO::PARAM_INT);


try{
    $request->execute();
}catch(Exception $e){
    die($e->getMessage());
}
$resultat = $request->fetchAll();

// exécution dans l'execute d'un tableau avec marqueurs nommés 
$request = $PDOConnect->prepare("SELECT `nom`, `population` FROM `countries` WHERE `population` BETWEEN :debut AND :fin ORDER BY `population` DESC ;");


try{
    $request->execute(["debut"=>$_POST['num1'],
                        "fin"=>$_POST['num2'],]);
}catch(Exception $e){
    die($e->getMessage());
}
$resultat2 = $request->fetchAll();


// Deuxième bindParam avec marqueurs nommés
elseif(isset($_POST['sup1'],$_POST['sup2'])):

    // Préparation de notre requête avec prepare et les marqueurs nommés avec :lenom
    $request = $PDOConnect->prepare("SELECT `nom`, `superficie` FROM `countries` WHERE `superficie` BETWEEN :petit AND :grand ORDER BY `superficie` DESC ;");
    
    // utilisation de bindValue(), version plus longue mais plus stricte que le tableau dans l'execute(). 1 représente le premier ? dans l'ordre de lecture (de haut en bas gauche à droite)
    $request->bindValue(":petit",$_POST['sup1'],PDO::PARAM_INT);
    $request->bindValue(":grand",$_POST['sup2'],PDO::PARAM_INT);
    
    try{
        $request->execute();
    }catch(Exception $e){
        die($e->getMessage());
    }
    $resultatSup = $request->fetchAll();
    
    // troisième bindParam avec marqueurs ?

    // Préparation de notre requête avec prepare et les marqueurs ?
    $request = $PDOConnect->prepare("SELECT `nom`, `superficie` FROM `countries` WHERE `superficie` BETWEEN ? AND ? ORDER BY `superficie`;");
    
    
    try{
        // on peut attribuer des bindValue en mettant un tableau indexé dans l'execute
        $request->execute([$_POST['sup1'],$_POST['sup2']]);

    }catch(Exception $e){
        die($e->getMessage());
    }
    $resultatSup2 = $request->fetchAll();
    
    endif;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prepare</title>
</head>
<body>
    <h1>Prepare</h1>
    <h2>bindValue</h2>
    <h3>Avec des marqueurs ?</h3>
    <h4>Choisissez le nombre d'habitants entre 2 nombres</h4>
    <p>Pour afficher les pays qui ont ce nombre d'habitants</p>
    <form action="" method="POST" name="marqueur">
        <input type="number" name="num1" value="1000000" max="10000000" step="100000"> à <input type="number" name="num2" value="10000000" min="10000000" step="100000"> <input type="submit" value="rechercher">
    </form>
    <?php
    if(isset($resultat)):
    ?>
    <h3>Pays ayant entre <?=number_format((int)$_POST['num1'], 0, '.', ' ');?> et <?=number_format((int)$_POST['num2'], 0, '.', ' ');?> habitants : <?=count($resultat)?></h3>
    <?php
        foreach($resultat as $item):
            ?>
        <p><?=$item['nom']?> | <?=number_format($item['population'],0,'.',' ')?> habitants</p>
            <?php
        endforeach;
        var_dump($resultat2);
    endif;
    ?>
    <h3>Avec des marqueurs nommés</h3>
    <h4>Choisissez la superficie du pays entre 2 nombres</h4>
    <p>Pour afficher les pays avec sa superficie</p>
    <form action="" method="POST" name="marqueur">
        <input type="number" name="sup1" value="1" max="10000" step="1000"> à <input type="number" name="sup2" value="20000000" min="100000" step="1000"> <input type="submit" value="rechercher">
    </form>
    <?php
    if(isset($resultatSup)):
    ?>
    <h3>Pays ayant entre <?=number_format((int)$_POST['sup1'], 0, '.', ' ');?> et <?=number_format((int)$_POST['sup2'], 0, '.', ' ');?> km2 : <?=count($resultatSup)?></h3>
    <?php
        foreach($resultatSup as $item):
            ?>
        <p><?=$item['nom']?> | <?=number_format($item['superficie'],0,'.',' ')?> km2</p>
            <?php
        endforeach;
        var_dump($resultatSup2);
    endif;
    ?>
</body>
</html>