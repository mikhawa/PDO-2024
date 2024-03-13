<?php
// normalement pas nécessaire car ce fichier est déjà appelé dans nos pages, mais le 'once' retire tous risques de conflict et permet de tester la connexion depuis ce fichier
require_once "config.php";

// tentative de connexion ... Essai
try {
    // création (instanciation de PDO) d'une connexion sans attributs (options)
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);

    /*
    utilisation de setAttribute() pour remplir (ou changer) les options de connexions
    */

    // activation de l'affichage des erreurs POUR les requêtes SQL (pas pour les erreurs de connexion)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // pour l'activation du fetch mode par défaut en tableau associatif en ASSOC
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Sinon on a une erreur, on capture l'erreur  dans $e en utilisant la classe native PDOexception ou de préférence Exception (elles sont liées dans l'installation de PHP)
} catch (Exception $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
    // arrêt du script en cas d'erreur de connexion exit ou die
    exit("<h3>Site en maintenance</h3>");
}
