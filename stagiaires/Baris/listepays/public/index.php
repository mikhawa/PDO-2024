<?php 
/* contrôleur frontale 
*/

//  chargement des dépendances
// 
require_once "../config.php";

try { 
     $db = new PDO(MY_DB_TYPE.":host=".MY_DB_HOST.";port=".MY_DB_PORT.";dbname=".MY_DB_NAME.";dbname=".MY_DB_NAME.";charset=".MY_DB_CHARSET, MY_DB_LOGIN, MY_DB_PWD);
}catch(Exception $e){
    // arrêt du script et affichage de l'erreur 
    die("erreur : ".$e-> getMessage());
}

// requête sur la DB (model car gestion de données)

$sql = "SELECT* FROM countries"; // requête non executée
$query = $db->query($sql); // execution de la requête de type SELECT avec query()

echo $countQuery = $query -> rowCount(); // nombre de résultats de notre requête

/* récupération du template d'affichage, on utilisera la boucle while avec un fetch directement dans la vue */

include "../view/homepage.view.php"; 

// BONNE PRATIQUE ( autres DB que MySQL ou MariaDB)
$query->closeCursor();

// déconnexion ( bonne pratique)

$db=null;