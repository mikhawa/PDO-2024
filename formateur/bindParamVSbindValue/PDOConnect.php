<?php
require_once "config.php";

// on va utiliser un try catch pour gérer les erreurs de connexion
try{

    $PDOConnect = new PDO(DB_TYPE.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=".DB_CHARSET, DB_LOGIN, DB_PWD);
    
    // on va fixer le FETCH_MODE par défault en FETCH_ASSOC
    $PDOConnect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// si on a une erreur on la capture dans l'objet de type Exception
}catch(Exception $e){
    // code erreur
    echo "<h3>".$e->getCode()."</h3>";
    // message erreur et arrêt du script
    die($e->getMessage());
}