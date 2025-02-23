<?php
session_start();
require 'config.php';
include 'menu.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Vérifier le type d'utilisateur
$sql = "SELECT type_utilisateur FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch();

if ($user['type_utilisateur'] != 'eleveur') {
    // Rediriger si l'utilisateur n'est pas un éleveur
    header("Location: index.php");
    exit();
}

// Récupérer les élevages de l'éleveur
$sql = "SELECT * FROM elevages WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$elevages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Éleveur</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur votre Dashboard </h1>
        <span class="badge">Type : Éleveur</span> <!-- Affichage du type d'utilisateur -->
    </header>

    <section>
        <h2>Vos Élevages</h2>
        <table border="1">
            <tr>
                <th>Nom de l'Élevage</th>
                <th>Description</th>
                <th>Localisation</th>
            </tr>
            <?php foreach ($elevages as $elevage): ?>
                <tr>
                    <td><?= htmlspecialchars($elevage['nom']) ?></td>
                    <td><?= htmlspecialchars($elevage['description']) ?></td>
                    <td><?= htmlspecialchars($elevage['localisation']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <footer>
        <p>&copy; 2024 Marché Animalier</p>
    </footer>
</body>
</html>
