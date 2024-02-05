<?php
/*
** Contrôleur frontal
*/

// chargement des dépendances
require_once "../config.php"; // constantes
require_once "../model/CountriesModel.php"; // fonctions countries
require_once "../model/PaginationModel.php"; // fonctions de pagination

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

// si on a une page, on la récupère, sinon on prend la première
if(isset($_GET[MY_PAGINATION_GET])) $page = (int) $_GET[MY_PAGINATION_GET];
else $page = 1;

// récupération du nombre de pays
$nbPays = getNumberCountries($db);

// création de la pagination si plus d'une page
$pagination = PaginationModel('./', MY_PAGINATION_GET, $nbPays, $page, MY_PAGINATION_BY_PAGE);

// récupération des pays
$allCountries = getCountriesByPage($db, $page, MY_PAGINATION_BY_PAGE);

/* récupération du template d'affichage, 
on utilisera la boucle while avec un fetch directement
dans la vue */

include "../view/homepage.view.php";

// déconnexion (bonne pratique)
$db=null;