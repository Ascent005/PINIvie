<?php
    include 'menu.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'config.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: connexion.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $type_utilisateur = $_SESSION['type_utilisateur'];

    if ($type_utilisateur === 'client') {
        $sql = "SELECT commandes.id, animaux.type, animaux.race, animaux.prix, commandes.statut, commandes.date_commande
                FROM commandes
                JOIN animaux ON commandes.animal_id = animaux.id
                WHERE commandes.id_client = :user_id";
    } else {
        $sql = "SELECT commandes.id, animaux.type, animaux.race, animaux.prix, commandes.statut, commandes.date_commande
                FROM commandes
                JOIN animaux ON commandes.animal_id = animaux.id
                WHERE animaux.id_elevage = :user_id";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $commandes = $stmt->fetchAll();
?>
    
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Commandes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Mes Commandes</h2>
    <table border="1">
        <tr>
            <th>Type</th>
            <th>Race</th>
            <th>Prix</th>
            <th>Statut</th>
            <th>Date</th>
        </tr>
        <?php foreach ($commandes as $commande): ?>
            <tr>
                <td><?= $commande['type'] ?></td>
                <td><?= $commande['race'] ?></td>
                <td><?= $commande['prix'] ?> FCFA</td>
                <td><?= $commande['statut'] ?></td>
                <td><?= $commande['date_commande'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
