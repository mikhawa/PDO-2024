<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les pays du monde</title>
</head>
<body>
    <h1>Les pays du monde</h1>
    <h3>Nombre de pays dans notre liste : <?=$nbPays?></h3>
    <p>Utilisation de la boucle foreach sur le tableau indexé créé par un fetchAll() pour lister tous les pays.</p>
    <pre><code>
        foreach($allCountries as $item)
        {
            echo "$item[nom]";
        }
    </code></pre>
    <div>
        <?php
        // var_dump($allCountries);
        /* Tant qu'on a des pays à lister venant
        d'un tableau indexé (fetchAll) *
        */
        if(empty($allCountries)) :
            echo "Pas de Pays listé";
        else:
            foreach($allCountries as $item):
        ?>
        <p><?=$item['nom']?></p>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</body>
</html>