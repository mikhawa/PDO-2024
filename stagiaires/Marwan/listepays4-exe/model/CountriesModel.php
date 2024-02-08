<?php

// création d'une fonction qui récupère tous les pays dans la db listepays, elle a besoin d'une connexion PDO pour fonctionner, si indique PDO devant le paramètre, on ne peut qu'accepter un objet de type PDO.
// Cette fonction va nous renvoyer un array
function getAllCountries(PDO $connectDB): array
{
    $sql = "SELECT nom FROM countries"; // requête non exécutée
    $query = $connectDB->query($sql); // exécution de la requête de type SELECT avec query()
    // convertion des données en un tableau indexé (fetchAll) qui contient chaque ligne de résultat en tableau associatif (voir connexion)
    $datas = $query->fetchAll();
    // bonne pratique (autres DB que MySQL ou MariaDB)
    $query->closeCursor();
    // envoie du tableau indexé contenant les pays
    return $datas;
}
 
// nous retourne le nombre de pays avec une requête simple (COUNT)
function getNumberCountries(PDO $connect): int
{
   /* $query = $connect->query("SELECT COUNT('id') AS nb FROM countries");
    $result = $query->fetch();
    return $result['nb'];*/

    return $connect->query("SELECT COUNT('id') AS nb FROM countries")->fetch()['nb'];
}

// nous affiche les pays par rapport à la page ! lien avec pagination !
function getCountriesByPage(PDO $dbConnect, 
                            int $currentPage=1, 
                            int $nbByPage=20): array
{
    // pour avoir le offset, donc le démmarage du LIMIT 
    $offset = ($currentPage-1)*$nbByPage;

    // création de la requête
    $sql = "SELECT nom FROM countries LIMIT $offset, $nbByPage ";
    // exécution de la requête
    $query = $dbConnect->query($sql);
    // envoi du tableau de résultat avec fetchAll (tab indexé contenant des assoc)
    
    return $query->fetchAll();
}
