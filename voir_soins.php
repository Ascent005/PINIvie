<?php
    session_start();
    require 'config.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['type_utilisateur'] !== 'eleveur') {
        header("Location: connexion.php");
        exit();
    }

    $elevage_id = $_SESSION['user_id'];

    $sql = "SELECT soins_animaux.*, animaux.type, animaux.race 
            FROM soins_animaux 
            JOIN animaux ON soins_animaux.animal_id = animaux.id 
            WHERE animaux.elevage_id = :elevage_id
            ORDER BY soins_animaux.date_soin DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['elevage_id' => $elevage_id]);
    $soins = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des soins</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Historique des soins</h2>
    <table border="1">
        <tr>
            <th>Animal</th>
            <th>Type de soin</th>
            <th>Date</th>
            <th>Commentaire</th>
        </tr>
        <?php foreach ($soins as $soin): ?>
            <tr>
                <td><?= $soin['type'] . " - " . $soin['race'] ?></td>
                <td><?= $soin['type_soin'] ?></td>
                <td><?= $soin['date_soin'] ?></td>
                <td><?= $soin['commentaire'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
