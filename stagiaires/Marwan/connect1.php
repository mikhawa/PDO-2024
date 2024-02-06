<?php

// paramètres de connexions
require_once "config1.php";

# Connexion PDO
try {
    $connectPDO = new PDO(
        DB_TYPE.':host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset='.DB_CHARSET,
        DB_LOGIN,
        DB_PWD
    );
    /*
    $connectPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connectPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    */
}catch(Exception $e){
    // on peut gérer les erreurs
    if($e->getCode()===1045):
        echo "Mauvais nom d'utilisateur";
    endif;
    die($e->getMessage());

}
