<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listepays</title>
</head>
<body>
    <h1>Listepays vue exemple</h1>
    <h2>Liste de tous les pays du monde</h2>
    <h3>Nombre de pays : <?=$nbPays?> - <a href="exemple.php">exemple à mettre en place</a> | <a href="./">Accueil (CF)</a></h3>
    

    <?php //var_dump($allCountries)?>

    <h4>Liste des pays</h4>
    <?php
    if(isset($pagination)) echo "$pagination<hr>"; 
    ?>
    
    <p>
    <?php
    $i=($page-1)*MY_PAGINATION_BY_PAGE +1;
    foreach($countriesByPage as $countries):
    ?>
    <p><?="Ligne ".$i." ) ".$countries['nom'] ?></p>
    <?php
    $i++;
    endforeach;
    ?>
    </p>
    <?php
    if(isset($pagination)) echo "<hr>$pagination"; 
    ?>
</body>
</html>