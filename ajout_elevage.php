<?php
session_start();
require 'config.php';

// Vérifier si l'utilisateur est connecté et est un éleveur
if (!isset($_SESSION['user_id']) || $_SESSION['type_utilisateur'] !== 'eleveur') {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $localisation = $_POST['localisation'];
    $user_id = $_SESSION['user_id'];

    // Insérer l'élevage dans la base de données
    $sql = "INSERT INTO elevages (user_id, nom, description, localisation) VALUES (:user_id, :nom, :description, :localisation)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'nom' => $nom,
        'description' => $description,
        'localisation' => $localisation
    ]);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Élevage</title>
</head>
<body>
    <h1>Ajouter un nouvel élevage</h1>
    <form method="POST">
        <label for="nom">Nom de l'élevage :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="localisation">Localisation :</label>
        <input type="text" id="localisation" name="localisation" required><br>

        <button type="submit">Ajouter l'Élevage</button>
    </form>
</body>
</html>
