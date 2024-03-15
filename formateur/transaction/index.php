<?php
// Pour certaine Base de données, il vaut mieux utiliser une connexion permanente
// require_once "connectPDOPersist.php";

// pour InnoDB en mysql et mariadb, on a pas besoin de connexion permanente pour les transactions
require_once "DBConnect.php";

try {
    // on veut lancer une transaction (pour mysql et mariadb sur des tables acid: InnoDB)
    $db->beginTransaction(); // bloque l'autocommit, càd l'exécution des requêtes les unes après les autres (! certaines actions redémarrent l'autocommit, par exemple CREATE table etc... en général ce qui n'est pas nécessaire à un CRUD et touche à la structure de la base ou des tables)


    // une seule erreur, retour à l'état initial
    $db->exec("INSERT INTO theuser (theuserlogin,theusername) VALUES ('lulu92','lulu')");
    $var = $db->lastInsertId();

    $db->exec("INSERT INTO theuser (theuserlogin,theusername) VALUES ('lala11','$var')");

    $db->exec("UPDATE theuser SET theusername='lala91' WHERE theuserlogin='lala'");

    $db->exec("UPDATE theuser SET theuserlogin='lala' WHERE theuserlogin='lala6'");

    

    // toutes les actions sont exécutées en même temps (ordre de lecture) et validées ou invalidées en 1 trajet
    $db->commit();
} catch (Exception $e) {

    // retour en arrière (inutile pour mysql et mariaDB en InnoDB car ils le font par défaut)
    $db->rollBack();

    die($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les transactions</title>
</head>

<body>
<h1>Les transactions</h1>
<p>Maintenant que vous êtes connecté via PDO, vous devez comprendre comment PDO gère les transactions avant d'exécuter des requêtes. Si vous n'avez jamais utilisé les transactions, elles offrent 4 fonctionnalités majeures : Atomicité, Consistance, Isolation et Durabilité (ACID). En d'autres termes, n'importe quel travail mené à bien dans une transaction, même s'il est effectué par étapes, est garanti d'être appliqué à la base de données sans risque, et sans interférence pour les autres connexions, quand il est validé. Le travail des transactions peut également être automatiquement annulé à votre demande (en supposant que vous n'ayez encore rien validé), ce qui rend la gestion des erreurs bien plus simple dans vos scripts.<br><br>

    Les transactions sont typiquement implémentées pour appliquer toutes vos modifications en une seule fois ; ceci a le bel effet d'éprouver radicalement l'efficacité de vos mises à jour. En d'autres termes, les transactions rendent vos scripts plus rapides et potentiellement plus robustes (vous devez les utiliser correctement pour jouir de ces bénéfices).<br><br>

    Malheureusement, toutes les bases de données ne prennent pas en charge les transactions, donc PDO doit s'exécuter en mode "autocommit" lorsque vous ouvrez pour la première fois la connexion. Le mode "autocommit" signifie que toutes les requêtes que vous exécutez ont leurs transactions implicites, si la base de données le prend en charge ou aucune transaction si la base de données ne les prend pas en charge. Si vous avez besoin d'une transaction, vous devez utiliser la méthode PDO::beginTransaction() pour l'initialiser. Si le pilote utilisé ne prend pas en charge les transactions, une exception PDO sera lancée (en accord avec votre gestionnaire d'erreurs : ceci est toujours une erreur sérieuse). Une fois que vous êtes dans une transaction, vous devez utiliser la fonction PDO::commit() ou la fonction PDO::rollBack() pour la terminer, suivant le succès de votre code durant la transaction.<br><br>
    <a href="https://www.php.net/manual/fr/pdo.transactions.php" target="_blank">transactions en PHP official doc</a>
</p>
</body>

</html>
<?php
// à ne pas faire en cas de connexion permanente !
$db = null;
?>
