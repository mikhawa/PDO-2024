<?php
/*
** Contrôleur frontal 
*/

// chargement des dépendances
require_once "../config.php"; // constantes
require_once "../model/CountriesModel.php"; // fonctions lées à la table Countries
require_once "../model/PaginationModel.php";// fonction de pagination

// tentative de connexion
try{
    // création d'une instance de PDO 
    $db = new PDO(MY_DB_TYPE.":host=".MY_DB_HOST.";port=".MY_DB_PORT.";dbname=". MY_DB_NAME.";charset=".MY_DB_CHARSET, MY_DB_LOGIN, MY_DB_PWD);
    
    // on va mettre la valeur par défaut du format des fetch (la conversion des données récupérées en PHP) en tableau associatif, en utilisant PDO::FETCH_ASSOC
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// problème lors de la connexion, utilisation de la classe Exception    
}catch(Exception $e){

    // arrêt du script et affichage de l'erreur
    die("Erreur : ".$e->getMessage());
}

/* on récupère le nombre total de pays 
pour la pagination et pour le getCountriesByPage */
$nbPays = getNumberCountries($db);

/* si il existe une variable $_GET nommée comme MY_PAGINATION_GET et qu'elle
est un string contenant que les symboles numériques 0123456789 [0-9]* 
*/
if(isset($_GET[MY_PAGINATION_GET]) && ctype_digit($_GET[MY_PAGINATION_GET])){
    $page = (int) $_GET[MY_PAGINATION_GET];
}else{
    $page = 1;
}


$pagination = PaginationModel("exemple.php",MY_PAGINATION_GET,$nbPays,$page,MY_PAGINATION_BY_PAGE);


// requête sur la DB (se trouve dans le dossier model car gestion de données)
// A remplacer par getCountriesByPage
//$allCountries = getAllCountries($db); // remplacement par getCountriesByPage

$countriesByPage = getCountriesByPage($db,$page,MY_PAGINATION_BY_PAGE);

/* récupération du template d'affichage, 
on utilisera la boucle while avec un fetch directement
dans la vue */

include "../view/homepage.exemple.view.php";

// déconnexion (bonne pratique)
$db=null; 