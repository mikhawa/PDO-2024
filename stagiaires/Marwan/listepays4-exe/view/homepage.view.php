<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listepays</title>
</head>
<body>
    <h1>Listepays</h1>
    <h2>Liste de tous les pays du monde</h2>
    <h3>Nombre de pays : <?=count($allCountries)?></h3>
    <p><pre><code>Utilisation du foreach pour afficher le tableau des pays :
        
        foreach($allCountries as $countries):
            echo $countries['nom']; 
        endforeach;
    </code></pre></p>

    <?php //var_dump($allCountries)?>

    <h4>Liste des pays</h4>
    <p>
    <?php
    foreach($allCountries as $countries):
    ?>
    <p><?=$countries['nom'] ?></p>
    <?php
    endforeach;
    ?>
    </p>
</body>
</html>