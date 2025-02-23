<?php
    include 'menu.php';
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'config.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['type_utilisateur'] !== 'eleveur') {
        header("Location: connexion.php");
        exit();
    }

    $message = "";
    $elevage_id = $_SESSION['user_id'];

    // Récupérer les animaux de l'éleveur
    $sql = "SELECT id, type, race FROM animaux WHERE elevage_id = :elevage_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['elevage_id' => $elevage_id]);
    $animaux = $stmt->fetchAll();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $animal_id = $_POST['animal_id'];
        $type_soin = $_POST['type_soin'];
        $date_soin = $_POST['date_soin'];
        $commentaire = $_POST['commentaire'];

        $sql = "INSERT INTO soins_animaux (animal_id, type_soin, date_soin, commentaire) 
                VALUES (:animal_id, :type_soin, :date_soin, :commentaire)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            'animal_id' => $animal_id,
            'type_soin' => $type_soin,
            'date_soin' => $date_soin,
            'commentaire' => $commentaire
        ])) {
            $message = "Soin ajouté avec succès !";
        } else {
            $message = "Erreur lors de l'ajout du soin.";
        }
    }
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carnet de soins</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Ajouter un soin</h2>
    <form method="post">
        <select name="animal_id" required>
            <option value="">Sélectionner un animal</option>
            <?php foreach ($animaux as $animal): ?>
                <option value="<?= $animal['id'] ?>"><?= $animal['type'] . " - " . $animal['race'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="text" name="type_soin" placeholder="Type de soin (Ex: Vaccination)" required><br>
        <input type="date" name="date_soin" required><br>
        <textarea name="commentaire" placeholder="Commentaire (facultatif)"></textarea><br>
        <button type="submit">Ajouter</button>
    </form>
    <p><?= $message ?></p>
</body>
</html>