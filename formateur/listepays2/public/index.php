<?php
/*
**  Front Controller
*/

/* chargement des dépendances */
require_once("../config.php");

// on va utiliser un try catch pour gérer les erreurs de connexion
try{
    /* on va se connecter à la base de donnée
 en utilisant PDO. On instancie les objets en
 utilisant new, si on doit passer des arguments
 aux paramètres, on les mets dans les (). 
 Une méthode est appelée lorsqu'on utilise new :
 PDO::__construct(param1, param2, ....)*/
    $PDOConnect = new PDO(MY_DB_DRIVER.":host=".MY_DB_HOST.";port=".MY_DB_PORT.";dbname=".MY_DB_NAME.";charset=".MY_DB_CHARSET, MY_DB_LOGIN, MY_DB_PASS);
    
    // on va fixer le FETCH_MODE par défault en FETCH_ASSOC
    $PDOConnect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// si on a une erreur on la capture dans l'objet de type Exception
}catch(Exception $e){
    // code erreur
    echo "<h3>".$e->getCode()."</h3>";
    // message erreur et arrêt du script
    die($e->getMessage());

}

/* Création de la requête dans une variable
locale, bonne pratique pour futures requêtes
préparées */
$sql = "SELECT nom FROM countries";

/* Exécution réelle de la requête, on utilise
->query() uniquement pour les SELECT */
$query = $PDOConnect->query($sql);

/* on va compter le nombre de lignes affectées
 (chargées) par la requête $query en utilisant
 la méthode ->rowCount() */
$nbPays = $query->rowCount();

// si on a au moin un pays
if($nbPays!==0){
    // conversion des résultats venant de la DB en tableau indexé
    // avec chaque résultat convertit en tableau associatif
    $allCountries = $query->fetchAll();
}else{
    $allCountries=[];
}
// remettre le curseur à 0 pour réutiliser la
// requête (inutile pour MySQL et MariaDB)
$query->closeCursor();

// on ferme notre connexion (portabilité du code)
$PDOConnect = null;

//var_dump($allCountries);

/* On va charger la vue pour afficher tous les pays récupérés par la requête $query */
include_once "../view/homepage.view.php";



//var_dump($PDOConnect,$sql,$query,$nbPays);