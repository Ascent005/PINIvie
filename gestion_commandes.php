<?php
    include 'menu.php';

    session_start();
    require 'config.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['type_utilisateur'] !== 'eleveur') {
        header("Location: connexion.php");
        exit();
    }

    $elevage_id = $_SESSION['user_id'];
    $message = "";

    // Mettre à jour le statut
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commande_id'], $_POST['statut'])) {
        $commande_id = $_POST['commande_id'];
        $nouveau_statut = $_POST['statut'];

        $sql = "UPDATE commandes SET statut = :statut WHERE id = :commande_id AND animal_id IN 
                (SELECT id FROM animaux WHERE elevage_id = :elevage_id)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(['statut' => $nouveau_statut, 'commande_id' => $commande_id, 'elevage_id' => $elevage_id])) {
            $message = "Statut mis à jour avec succès !";
        } else {
            $message = "Erreur lors de la mise à jour.";
        }
    }

    // Récupérer les commandes des animaux de l'éleveur
    $sql = "SELECT commandes.id, commandes.client_id, users.nom, users.prenom, 
            commandes.date_commande, commandes.statut, animaux.type, animaux.race 
            FROM commandes 
            JOIN animaux ON commandes.animal_id = animaux.id 
            JOIN users ON commandes.client_id = users.id
            WHERE animaux.elevage_id = :elevage_id
            ORDER BY commandes.date_commande DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['elevage_id' => $elevage_id]);
    $commandes = $stmt->fetchAll();
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des commandes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Gestion des commandes</h2>
    <p><?= $message ?></p>
    <table border="1">
        <tr>
            <th>Client</th>
            <th>Animal</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        <?php foreach ($commandes as $commande): ?>
            <tr>
                <td><?= $commande['nom'] . " " . $commande['prenom'] ?></td>
                <td><?= $commande['type'] . " - " . $commande['race'] ?></td>
                <td><?= $commande['date_commande'] ?></td>
                <td><?= $commande['statut'] ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="commande_id" value="<?= $commande['id'] ?>">
                        <select name="statut">
                            <option value="En attente" <?= $commande['statut'] == 'En attente' ? 'selected' : '' ?>>En attente</option>
                            <option value="Confirmé" <?= $commande['statut'] == 'Confirmé' ? 'selected' : '' ?>>Confirmé</option>
                            <option value="Livré" <?= $commande['statut'] == 'Livré' ? 'selected' : '' ?>>Livré</option>
                        </select>
                        <button type="submit">Mettre à jour</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>