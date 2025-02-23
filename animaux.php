<?php

include 'menu.php';
    require 'config.php';

    $stmt =$pdo->query("SELECT * FROM animaux WHERE statut = 'disponible'");
    $animaux = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Animaux en vente</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h2>Animaux disponibles</h2>
        <div class="animaux">
            <?php foreach ($animaux as $animal) : ?>
                <div class="animal">
                    <img src="<?= $animal['image'] ?>" alt="<?= $animal['type'] ?>">
                    <h3><?= $animal['type'] ?> - <?= $animal['race'] ?></h3>
                    <p>Âge: <?= $animal['age'] ?> ans</p>
                    <p>Poids: <?= $animal['poids'] ?> kg</p>
                    <p>Prix: <?= $animal['prix'] ?> FCFA</p>
                    <a href="acheter.php?id=<?= $animal['id'] ?>" class="btn">Acheter</a>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>
