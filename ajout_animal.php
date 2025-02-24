<?php
    

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'config.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['type_utilisateur'] !== 'eleveur') {
        header("Location: connexion.php");
        exit();
    }

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = $_POST['type'];
        $race = $_POST['race'];
        $age = $_POST['age'];
        $poids = $_POST['poids'];
        $prix = $_POST['prix'];
        $description = $_POST['description'];
        $elevage_id = $_SESSION['user_id'];

        // Gestion de l'image
        $image = "images/default.png";  // Image par défaut
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $dossier = "images/";
            $nomImage = basename($_FILES['image']['name']);
            $chemin = $dossier . $nomImage;
            move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
            $image = $chemin;
        }

        $sql = "INSERT INTO animaux (elevage_id, type, race, age, poids, prix, description, image) 
                VALUES (:elevage_id, :type, :race, :age, :poids, :prix, :description, :image)";
        
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            'elevage_id' => $elevage_id,
            'type' => $type,
            'race' => $race,
            'age' => $age,
            'poids' => $poids,
            'prix' => $prix,
            'description' => $description,
            'image' => $image
        ])) {
            $message = "Animal ajouté avec succès !";
        } else {
            $message = "Erreur lors de l'ajout.";
        }
    }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un animal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <?php include 'menu.php'; ?>
    </header>
    <h2>Ajouter un animal</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="type" placeholder="Type d'animal (Ex: Bœuf, Mouton...)" required><br>
        <input type="text" name="race" placeholder="Race" required><br>
        <input type="number" name="age" placeholder="Âge en années" required><br>
        <input type="number" step="0.1" name="poids" placeholder="Poids en kg" required><br>
        <input type="number" step="0.01" name="prix" placeholder="Prix en FCFA" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="file" name="image"><br>
        <button type="submit">Ajouter</button>
    </form>
    <p><?= $message ?></p>
</body>
</html>
